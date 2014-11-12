<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call('TopupTableSeeder');
		$this->call('RedeemTableSeeder');
		$this->call('IncreaseLimitTableSeeder');
		$this->call('TransferTableSeeder');
		$this->call('PurchaseTableSeeder');
		$this->call('ProductTableSeeder');
	}

}

class TopupTableSeeder extends Seeder {
    public function run()
    {
        DB::table('topup')->delete();
        Topup::create(array(
        	'date_topup' => '2014/10/20 18:10:14',
        	'status' => 'success',
        	'amount' => 250000,
        	'permata_va_number' => '7546344512341',
        	'username_customer' => 'gumarus.william',
        ));
        Topup::create(array(
            'date_topup' => '2014/10/22 18:10:14',
            'status' => 'pending',
            'amount' => 120000,
            'permata_va_number' => '7546344512334',
            'username_customer' => 'gumarus.william',
        ));
    }
}

class RedeemTableSeeder extends Seeder {
    public function run()
    {
        DB::table('redeem')->delete();
        Redeem::create(array(
        	'date_redeem' => '2014/10/28 18:10:14',
        	'amount' => 75000,
        	'bank_account_name_receiver' => 'Gumarus Dharmawan William',
        	'bank_account_number_receiver' => '932372376',
        	'bank_name' => 'Mandiri',
        	'username_customer' => 'gumarus.william',
        	'redeemed' => 'false',
        ));
    }
}

class IncreaseLimitTableSeeder extends Seeder {
    public function run()
    {
        DB::table('increase_limit')->delete();
        IncreaseLimit::create(array(
        	'date_increase_limit' => '2014/10/22 18:10:14',
        	'full_name' => 'Gumarus Dharmawan William',
        	'id_type' => 'KTP',
        	'id_number' => '9103434342149',
        	'gender' => 'male',
        	'birth_place' => 'Samarinda',
        	'birth_date' => '1993/10/22',
        	'id_address' => 'Jalan Belatuk 2 Samarinda',
        	'current_address' => 'Jalan Tubagus Ismail 8 Dalam Bandung',
        	'message' => 'Kurang nih satu juta.',
        	'username_customer' => 'gumarus.william',
        	'status' => 'in process',
        ));
    }
}

class TransferTableSeeder extends Seeder {
    public function run()
    {
        DB::table('transfer')->delete();
        Transfer::create(array(
        	'date_transfer' => '2014/10/23 18:10:14',
        	'from_username' => 'gumarus.william',
        	'to_username' => 'daniel',
        	'amount' => 500000,
        ));
        Transfer::create(array(
            'date_transfer' => '2014/10/24 18:10:14',
            'from_username' => 'gumarus.william',
            'to_username' => 'danny.pranoto',
            'amount' => 150000,
        ));
    }
}

class PurchaseTableSeeder extends Seeder {
    public function run()
    {
        DB::table('purchase')->delete();
        $purchase1 = Purchase::create(array(
                    	'date_purchase' => '2014/10/24 18:10:14',
                    	'username_customer' => 'gumarus.william',
                    	'status' => 'success',
                    ));
        $purchase1->product()->attach(1, array('quantity' => 1));
        $purchase1->product()->attach(2, array('quantity' => 3));
        $purchase1->product()->attach(3, array('quantity' => 2));
        $purchase2 = Purchase::create(array(
                        'date_purchase' => '2014/10/25 18:10:14',
                        'username_customer' => 'daniel',
                        'status' => 'success',
                    ));
        $purchase2->product()->attach(1, array('quantity' => 1));
        $purchase2->product()->attach(3, array('quantity' => 1));
    }
}

class ProductTableSeeder extends Seeder {
    public function run()
    {
        DB::table('product')->delete();
        Product::create(array(
        	'product_name' => 'Nikon D5100 non VR',
        	'description' => 'Middle end camera made by Nikon.',
        	'price' => 300000,
        	'merchant_name' => 'merc1',
        ));
        Product::create(array(
            'product_name' => 'Lens 18-140mm',
            'description' => 'Lens tele.',
            'price' => 500000,
            'merchant_name' => 'merc1',
        ));
        Product::create(array(
            'product_name' => 'Nikon D3100 VR',
            'description' => 'Low end camera made by Nikon.',
            'price' => 100000,
            'merchant_name' => 'merc1',
        ));
    }
}