<?php

class AdminController extends BaseController {

	public function __construct(){
		$this->beforeFilter(function(){
			$role = ConnectHelper::getCurrentUserRole();
			if ($role == Config::get('connect_variable.merchant')){
				return Redirect::to('merchants/transaction');
			}
			elseif ($role == Config::get('connect_variable.unverified_user') || $role == Config::get('connect_variable.verified_user')){
				return Redirect::to('customers/dashboard');
			}
			elseif ($role != Config::get('connect_variable.admin')){
				if (Request::path() != 'admin/login'){
					Session::flash('errors', 'Please login first with your account');
					return Redirect::to('admin/login');
				}
			}
		});	
	}

	public function login(){

		if(Session::get('cyclos_group') == Config::get("connect_variable.admin")){
			return Redirect::to('/admin/dashboard');
		}
		else{
			if(Request::getMethod() == 'GET'){
				return View::make('/admin/login');	
			}
			elseif(Request::getMethod() == 'POST'){
				$loginService = new Cyclos\Service('loginService');

				// Set the parameters
				$params = new stdclass();
				$params->user = array('username' => $_POST['username']);
				$params->password = $_POST['password'];
				$params->remoteAddress = $_SERVER['REMOTE_ADDR'];

				// Perform the login
				try {
					$result = $loginService->run('loginUser',$params,false);

					//print_r($result);
					Session::put('cyclos_session_token',$result->sessionToken);
					Session::put('cyclos_username',$params->user['username']);
					Session::put('cyclos_remote_address',$params->remoteAddress);
						
					// Getting the group name
					$params = new stdclass();
					$params->id = $result->user->id;

					$userService = new Cyclos\Service('userService');
					$result = $userService->run('getViewProfileData',$params,false);

					if($result->group->name != Config::get('connect_variable.admin')){
						Session::flush();
						Session::flash('errors', 'Invalid username/password');
						return View::make('/admin/login');
					}

					Session::put('cyclos_group',$result->group->name);
					Session::put('cyclos_email',$result->email);
					return Redirect::to('/admin/dashboard');
				} catch (Cyclos\ConnectionException $e) {
					echo("Cyclos server couldn't be contacted");
					die();
				} catch (Cyclos\ServiceException $e) {
					switch ($e->errorCode) {
						case 'VALIDATION':
							Session::flash('errors', 'Missing username/password');
							return View::make('/admin/login');
							break;
						case 'LOGIN':
							Session::flash('errors', 'Invalid username/password');
							return View::make('/admin/login');
							break;
						case 'REMOTE_ADDRESS_BLOCKED':
							Session::flash('errors', 'Your access is blocked by exceeding invalid login attempts');
							return View::make('/admin/login');
							break;
						default:
							Session::flash('errors', 'Error while performing login: {$e->errorCode}');
							return View::make('/admin/login');
							break;
					}
					Session::flush();
					die();
				}
			}
		}
	}

	public function logout(){
		Session::flush();
		$params = new stdclass();
		$loginService = new Cyclos\Service('loginService');
		try {
			$loginService->run('logout',array(),true);
			return Redirect::to("/admin/login");
		}catch (Cyclos\ConnectionException $e) {
			echo("Cyclos server couldn't be contacted");
			die();
		} catch (Cyclos\ServiceException $e) {
			echo("Error while performing logout: {$e->errorCode}");
		}
		die();
	}

	public function dashboard(){
		$topups = Topup::all();
		$transfers = Transfer::all();
		$purchases = Purchase::all();
		return View::make('/admin/dashboard')
			->with('topups', $topups)
			->with('transfers', $transfers)
			->with('purchases', $purchases);
	}

	public function download_csv() {
		$transaction_type = Input::get('transaction_type');

		if ($transaction_type == 'topup'){
			$topups_data = Topup::all();
			$filename = 'Topup_Data.csv';
			$fp = fopen($filename, 'w');
			$topup_header= array("topup_id", "date_time", "status", "amount", "permata_va_number", "username_customer");
			fputcsv($fp, $topup_header);
	        foreach( $topups_data as $topup ) {
	        	$topup_array = $topup->toArray();
	            fputcsv($fp, $topup_array);
        	}
		} elseif ($transaction_type == 'transfer'){
			$transfers_data = Transfer::all();
			$filename = 'Transfer_Data.csv';
			$fp = fopen($filename, 'w');
			$transfer_header= array("transfer_id", "date_time", "from_username", "to_username", "amount");
			fputcsv($fp, $transfer_header);
	        foreach( $transfers_data as $transfer ) {
	        	$transfer_array = $transfer->toArray();
	            fputcsv($fp, $transfer_array);
	        }
		} elseif ($transaction_type == 'purchase'){
			$purchases_data = Purchase::all();
			$filename = 'Purchase_Data.csv';
			$fp = fopen($filename, 'w');	
			$purchase_header= array("purchase_id", "date_purchase", "username_customer", "status", "total");
			fputcsv($fp, $purchase_header);
	        foreach( $purchases_data as $purchase ) {
	        	$purchase_array = $purchase->toArray();
	        	array_push($purchase_array, $purchase->total());
	            fputcsv($fp, $purchase_array);
	        }
		}
		fclose($fp);

		App::finish(function($request, $response) use ($filename)
	    {
	        unlink($filename);
	    });

        return Response::download($filename);
	}

	public function notification(){
		$redeems = Redeem::where('redeemed', '=', 'false')->get();
		$increase_limits = IncreaseLimit::where('status', '=', 'in process')->get();
		return View::make('/admin/notification')
			->with('redeems', $redeems)
			->with('increase_limits', $increase_limits);
	}

	public function manage_user(){
		// Getting all rules
		$userService = new Cyclos\Service('userService');

		// Getting account role
		$usersResult = $userService->run('getUserRegistrationGroups',array(),false);
		$roleId = array();
		foreach($usersResult as $group){
			$roleId[$group->name] = $group->id;
		}

		// Getting users
		$groupService = new Cyclos\Service('groupService');
		$result = $groupService->run('getSearchData',array(),false);
		foreach($result->groupSets as $group){
			if($group->name == Config::get('connect_variable.group_set_user')){
				$group_set_id = $group->id;
				break;
			}
		}

		$params = new stdclass();
		$params->groups = new stdclass();
		$params->groups->id = $group_set_id;
		$params->pageSize = PHP_INT_MAX;
		$usersResult = $userService->run('search',$params,false);

		if(isset($usersResult->pageItems)){
			$users = $usersResult->pageItems;
		}else{
			$users = array();
		}	

		// Getting merchant
		$params = new stdclass();
		$params->groups = new stdclass();
		$params->groups->id = $roleId[Config::get('connect_variable.merchant')];
		$params->pageSize = PHP_INT_MAX;
		$merchantsResult = $userService->run('search',$params,false);
		if(isset($merchantsResult->pageItems)){	
			$merchants = $merchantsResult->pageItems;
		}else{
			$merchants = array();
		}

		$profiles = array();
		// Getting user attribute
		foreach($users as $user){
			//Getting user email
			$params = new stdclass();
			$params->id = $user->id;
			$result = $userService->run('getViewProfileData',$params,false);
			$user->email = $result->email;

			//Getting user balance
			$accountService = new Cyclos\Service('accountService');
			$result = $accountService->run('getAccountsSummary',array(array("username"=>$user->username),array("date"=>"null")),false);
			$user->balance = intval($result[0]->balance->amount);
			$user->limitBalance = intval($result[0]->status->upperCreditLimit);

			//Getting user profile
			$profile = IncreaseLimit::where('username_customer',$user->username)->first();
			$profiles[$user->username] = $profile;
		}

		// Getting merchant attributes
		foreach($merchants as $merchant){
			// Getting merchant email
			$params = new stdclass();
			$params->id = $merchant->id;
			$result = $userService->run('getViewProfileData',$params,false);
			$merchant->email = $result->email;

			// Getting merchant balance
			$accountService = new Cyclos\Service('accountService');
			$result = $accountService->run('getAccountsSummary',array(array("username"=>$merchant->username),array("date"=>"null")),false);
			$merchant->balance = intval($result[0]->balance->amount);
		}
		return View::make('/admin/manage-user')->with('merchants',$merchants)->with('users',$users)->with('profiles',$profiles);
	}

	public function redeem_user(){
		$userService = new Cyclos\Service('userService');
		$userGroupService = new Cyclos\Service('userGroupService');
		try{
			// Validate redeemation
			$redeem = Redeem::find(Input::get('redeem_id'));
			if($redeem->redeemed == true){
				throw new Exception();
			}

			// Getting user id
			$params = new stdclass();
			$params->keywords = Input::get('redeem_username');
			$result = $userService->run('search',$params,false);
			$user_id = $result->pageItems[0]->id;
			
			// Get group
			$result = $userService->run("getUserRegistrationGroups",array(),false);
			$group_id;

			foreach($result as $res){
				if($res->name == Config::get('connect_variable.closed_user_account')){
					$group_id = $res->id;
					break;
				}
			}

			// Change the group
			$params = new stdclass();
			$params->group = new stdclass();
			$params->group->id = $group_id;

			$params->user = new stdclass();
			$params->user->id = $user_id;
			$result = $userGroupService->run('changeGroup',$params,false);

			$redeem->redeemed = true;
			$redeem->save();
			

			Session::put('_token', sha1(microtime()));

			return View::make('admin/close-account-success');
		}catch(Exception $e){
			echo 'There are some trouble, please try again later.';
		}
	}

	public function create_merchant(){
		if ( Session::token() !== Input::get( '_token' ) ) {
            return Response::json( array(
                'msg' => 'Unauthorized attempt to create setting'
            ) );
        }else{
        	$rules = array(
				'merchant_name'	=> 'required',
				'merchant_email'=> 'required|email'
			);

			$validator = Validator::make(Input::all(), $rules);

			if($validator->fails()){
	            return Redirect::to('admin/manage-user#manage-merchant#create-merchant')->withInput()->withErrors($validator);
			}else{
				$userService = new Cyclos\Service('userService');
				$result = $userService->run("getUserRegistrationGroups",array(),false);
				$id;

				try{
					$result = $userService->run("getUserRegistrationGroups",array(),false);
					$id;

					foreach($result as $res){
						if($res->name == Config::get('connect_variable.merchant')){
							$id = $res->id;
						}
					}

					$params = new stdclass();
					$params->group = new stdclass();
					$params->group->id = $id;

					$params->username = $_POST['merchant_name'];
					$params->email = $_POST['merchant_email'];
					$params->name = $_POST['merchant_name'];

					$userService->run('register',$params,false);

					//Change to random password and send password
					$alpha = "abcdefghijklmnopqrstuvwxyz";
					$alpha_upper = strtoupper($alpha);
					$numeric = "0123456789";
					$special = ".-+=_,!@$#*%<>[]{}";
					$chars = "";
					 
				    // default [a-zA-Z0-9]{9}
				    $chars = $alpha . $alpha_upper . $numeric;
				    $length = 9;
					 
					$len = strlen($chars);
					$pw = '';

					//ensuring password policy
					$pw .= substr($alpha, rand(0, strlen($alpha)-1), 1);
				 	$pw .= substr($alpha_upper, rand(0, strlen($alpha_upper)-1), 1);
				 	$pw .= substr($numeric, rand(0, strlen($numeric)-1), 1);

					for ($i=0;$i<$length;$i++)
			        	$pw .= substr($chars, rand(0, $len-1), 1);
					 
					// the finished password
					$pw = str_shuffle($pw);

					//Sending new password
					//getting user id

					$userService = new Cyclos\Service('userService');
					$params = new stdclass();
					$params->email = Input::get('merchant_email');

					$result = $userService->run('getViewProfileData',$params,false);

					$user_id = $result->user->id;
					$username = $result->user->username;
					Session::put('temp_username',$username);

					//getting login password data
					$passwordTypeService = new Cyclos\Service('passwordTypeService');
					$result = $passwordTypeService->run('list',array(),false);				

					foreach($result as $type){
						if($type->name == Config::get('connect_variable.cyclos_login_password')){
							$login_password_type = $type;
						}
					}

					//changin the password in cyclos
					$passwordService = new Cyclos\Service('passwordService');
					
					$changePasswordDTO = new stdclass();
					$changePasswordDTO->type = $login_password_type;
					$changePasswordDTO->user = new stdclass();
					$changePasswordDTO->user->id = $user_id;
					$changePasswordDTO->newPassword = $pw;
					$changePasswordDTO->confirmNewPassword = $pw;

					$passwordService->run('change',$changePasswordDTO,false);
					Mail::send('emails.register', array('password' => $pw,
															   'username' => $username), function($message)
					{
						$message->from('connect_cs@connect.co.id', 'Connect');
					    $message->to(Input::get('merchant_email'), Session::pull('temp_username'))->subject('Registration Detail');
					});

					return View::make('admin/create-merchant-success');
				}catch (Cyclos\ServiceException $e){
					if($e->errorCode == "VALIDATION"){
						$errors = "";
						foreach($e->error->validation->propertyErrors as $error){
							$errors = $errors . $error[0] . "\n";
						}
						Session::flash('errors',$errors);
						var_dump($errors);	
					}else{
						Session::flash('errors',$e->errorCode);
						var_dump($e->errorCode);
					}
				}

				$params = new stdclass();
				$params->group = new stdclass();
				$params->group->id = $id;

				$params->username = $_POST['merchant_name'];
				$params->email = $_POST['merchant_email'];
				$params->name = $_POST['merchant_name'];

				$userService->run('register',$params,false);
				return View::make('admin/create-merchant-success');
			}
        }
	}

	public function add_product(){
		//check if its our form
        if ( Session::token() !== Input::get( '_token' ) ) {
            return Response::json( array(
                'msg' => 'Unauthorized attempt to create setting'
            ) );
        }else{
        	$rules = array(
				'product_name'	=> 'required',
				'description'	=> 'required',
				'price'			=> 'required|numeric|min:1',
				'merchant_name' => 'required'
			);

			$validator = Validator::make(Input::all(), $rules);

			if($validator->fails()){
				if(Request::ajax())
	            {
	                return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
	            } else{
	                return Redirect::back()->withInput()->withErrors($validator);
	            }
			}else{
				Product::create(array(
					'product_name' 	=> Input::get('product_name'),
					'description' 	=> Input::get('description'),
					'price' 		=> Input::get('price'),
					'merchant_name' => Input::get('merchant_name')
				));

				return Response::json(['success' => true], 200);
			}

        }
	}

	public function reject_increase_limit(){
		$rules = array(
			'denial_messages'	=> 'required'
		);

		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()){
			return Redirect::to('admin/notification#increase-limit#confirm-request#deny')->withErrors($validator);
		}else{		
			$increase_limit = IncreaseLimit::find(Input::get("increase_limit_id"));//->update(array('status' => ($response->transaction_status)));
			$increase_limit->message = Input::get('denial_message');
			$increase_limit->status = 'denied';
			$increase_limit->save();

			Mail::send('emails.increase_limit_rejected', array('customer_username' => Input::get('increase_limit_username'),
															   'denial_message' => Input::get('denial_message')), function($message)
			{
				$message->from('connect_cs@connect.co.id', 'Connect');
			    $message->to(ConnectHelper::getUserEmail(Input::get('increase_limit_username')), Input::get('increase_limit_username'))->subject('Request for Increase Limit Rejected');
			});

			Session::put('_token', sha1(microtime()));
			return View::make('admin/increase-limit-rejected');
		}
	}

	public function accept_increase_limit(){
		$userService = new Cyclos\Service('userService');
		$userGroupService = new Cyclos\Service('userGroupService');

		//GETTING USER ID
		$user_id;
		$params = new stdclass();
		$params->nameOrUsername = Input::get('increase_limit_username');
		$result = $userService->run('search',$params,false);
		$user_id = $result->pageItems[0]->id;

		//GETTING GROUP ID FOR UPDATE
		$result = $userService->run("getUserRegistrationGroups",array(),false);
		$group_id;


		foreach($result as $res){
			if($res->name == Config::get('connect_variable.verified_user')){
				$group_id = $res->id;
				break;
			}
		}

		//UPDATE USER GROUP
		$params = new stdclass();
		$params->group = new stdclass();
		$params->group->id = $group_id;

		$params->user = new stdclass();
		$params->user->id = $user_id;
		$result = $userGroupService->run('changeGroup',$params,false);

		$increase_limit = IncreaseLimit::find(Input::get("increase_limit_id"));
		$increase_limit->status = 'accepted';
		$increase_limit->save();

		Mail::send('emails.increase_limit_approved', array('customer_username' => Input::get('increase_limit_username'),
														   'denial_message' => Input::get('denial_message')), function($message)
		{
		    $message->to(ConnectHelper::getUserEmail(Input::get('increase_limit_username')), Input::get('increase_limit_username'))->subject('Request for Increase Limit Approved');
		});

		Session::put('_token', sha1(microtime()));

		return View::make('admin/increase-limit-success');
	}

	public function delete_merchant(){
		//Change merchant group in cyclos
		$userService = new Cyclos\Service('userService');
		$userGroupService = new Cyclos\Service('userGroupService');
		try{

			// Getting user id
			$params = new stdclass();
			$params->nameOrUsername = Input::get('merchant_id');
			$result = $userService->run('search',$params,false);
			$user_id = $result->pageItems[0]->id;

			// Get group
			$result = $userService->run("getUserRegistrationGroups",array(),false);
			$group_id;

			foreach($result as $res){
				if($res->name == Config::get('connect_variable.closed_merchant_account')){
					$group_id = $res->id;
					break;
				}
			}

			// Change the group
			$params = new stdclass();
			$params->group = new stdclass();
			$params->group->id = $group_id;

			$params->user = new stdclass();
			$params->user->id = $user_id;
			$result = $userGroupService->run('changeGroup',$params,false);

			//Delete merchant product
			$products = Product::where('merchant_name',Input::get('merchant_id'))->delete();

			return View::make('admin/delete-merchant-success');
		}catch(Exception $e){
			echo 'There are some trouble, please try again later.';
		}
	}
}