@extends('layouts.default')

@section('content')
	<div id="subheader-wrapper">
	<span class="subtitle">PURCHASE PRODUCTS</span>
	<div class="balance">
	  Balance<br/>
	      <span class="currency">
	        Rp 1.500.000,00
	      </span><br/>
	        from the limit of 
	      @if(true)
	          Rp 5.000.000,00
	      @else
	          Rp 1.000.000,00
	      @endif
	</div>
	</div>

	<hr id="horizontal-line" noshade size=1 width=95% />

	<div id="subcontent-wrapper">
		<div id="subbuttons-wrapper" style="overflow:visible">
			<div class="table">
				<div class="column">
					<span style="font-size:18px; float:left; padding: 0 10px">Select Merchant</span>
					<div id="dd" class="wrapper-dropdown" style="float:left">
						<span>Select Merchant</span>
						<ul class="dropdown">
							<li id="el-1" name="el-1" value="lazada"><label for="el-1">Lazada</label></li>
							<li id="el-2" name="el-2" value="zalora"><label for="el-2">Zalora</label></li>
						</ul>
					</div>
				</div>
				

				
				<div class="column">
					<button class="button darkbrown profile" style="float:right">SHOPPING CART</button>
				</div>
			</div>

		</div>

        <div class="all-table admin">
            <table align="center">
                <thead>
                    <tr>
                        <th>
                            Transaction Type
                        </th>
                        <th>
                            Date & Time
                        </th>
                        <th>
                            Bank
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Description
                        </th>
                    </tr>
                </thead>
                <tr>
                    <td >
                        Row 1
                    </td>
                    <td>
                        Row 1
                    </td>
                    <td>
                        Row 1
                    </td>
                    <td>
                        Row 1
                    </td>
                    <td>
                        Row 1
                    </td>
                </tr>
                <tr>
                    <td>
                        Row 2
                    </td>
                    <td>
                        Row 2
                    </td>
                    <td>
                        Row 2
                    </td>
                    <td>
                        Row 2
                    </td>
                    <td>
                        Row 2
                    </td>
                </tr>
                <tr>
                    <td >
                        Row 3
                    </td>
                    <td>
                        Row 3
                    </td>
                    <td>
                        Row 3
                    </td>
                    <td>
                        Row 3
                    </td>
                    <td>
                        Row 3
                    </td>
                </tr>
                <tr>
                    <td >
                        Row 4
                    </td>
                    <td>
                        Row 4
                    </td>
                    <td>
                        Row 4
                    </td>
                    <td>
                        Row 4
                    </td>
                    <td>
                        Row 4
                    </td>
                </tr>
            </table>

        </div>

        <div id="subbuttons-wrapper" style="overflow:visible;">
        	<div class="table">
        		<div class="column">
					<button class="button darkbrown profile" style="float:right">PURCHASE</button>
        		</div>
        	</div>
        	
        </div>

	</div>

<!-- jQuery if needed -->
<script type="text/javascript">
			
			function DropDown(el) {
			    this.dd = el;
			    this.placeholder = this.dd.children('span');
			    this.opts = this.dd.find('ul.dropdown > li');
			    this.val = '';
			    this.index = -1;
			    this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						event.stopPropagation();
					});

					obj.opts.on('click',function(){
				            var opt = $(this);
				            obj.val = opt.text();
				            obj.index = opt.index();
				            obj.placeholder.text(obj.val);
				        });
			    },
			    getValue : function() {
			        return this.val;
			    },
			    getIndex : function() {
			        return this.index;
			    }
			}

			$(function() {

				var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown').removeClass('active');
				});

			});

		</script>

@stop