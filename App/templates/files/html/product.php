<div class="ltabs-item product-layout" data-atributes="<?php if(is_array($product->atributes)) {
		foreach($product->atributes as $atribute) {
			echo $atribute . "]]]";
		}
	} ?>" data-product-id="<?php echo $product->id ?>" data-bought-atributes="<?php echo $product->strGoodsAtributes ?>" <?php 
		    echo "data-product-min-order=";
		    if($product->minOrderQuantity != NULL) {
		        echo "\"" . $product->minOrderQuantity . "\"";
		    }
		    
	        echo " data-product-max-order=";
		    if($product->quantity != NULL) {
		        echo "\"" . $product->quantity . "\"";
		    }
		    
		    echo " data-brand-url=";
		    if($product->brand->url != NULL) {
		        echo "\"" . $product->brand->url . "\"";
		    }
		    
		    echo " data-product-url=";
		    if($product->url != NULL) {
		        echo "\"" . $product->url . "\"";
		    }
	    ?>>
	<div class="product-item-container">
		<div class="left-block">
			<div class="product-image-container ">
				<div class="image" style="margin-top: 5px; text-align: center;">
					<a class="lt-image" href="<?php echo $product->brand->url . '/' . $product->url ?>" title="<?php echo $product->name ?>">
						<img src="<?php echo $product->shortImg ?>" alt="<?php echo $product->name ?>" width="150px" height="150px">
					</a>
				</div>
			</div>
		</div>
    	<div class="box-label">
    	</div>
    	<div class="right-block">
    		<div class="caption" style="position: relative;">
    			<h4 style="margin-bottom: 30px;">
    				<a href="<?php echo $product->brand->url . '/' . $product->url ?>" title="<?php echo $product->name ?>" style="margin-top: 10px; display: inline-block;">
    					<?php echo $product->name ?>
    				</a>
    			</h4>
    			<?php if ($product->seller->isTrading == '0' || $product->isInStock == '0') { ?>
    			    <div class="stock-info stock-info--cat stock-info--not" style="position: absolute;bottom: -25px; line-height: 1;">
                    	<span class="stock-icon">
                    		<svg class="icon" width="7" height="8">
                    			<svg viewBox="0 0 137 156" id="icon-in-stock" xmlns="http://www.w3.org/2000/svg" style="fill: #676767;">
                    				<path d="M134.8 4.4v37.1H3.5V4.4h131.3zM3.2 154.6v-37.1h131.5v37.1H3.2zm131.7-93.5v36.7H3.4V61.1h131.5z" class="cest0"></path>
                    			</svg>
                    		</svg>
                    	</span>
                    	<span class="stock-text" style="color: #ff3a3a;">Ожидается <span style="display: inline-block; margin-left: 10px;">поступление</span></span>
                    </div>
                <?php } ?>
                <?php if($product->newPrice == NULL) { ?>
    			<p class="price" style="color: #000;">
    				<span><?php echo $product->price ?></span>&#8381;
    			</p>
    			<?php } else { ?>
    			    <span class="old-price" style="position: absolute; bottom: 20px; left: 0; text-decoration: line-through;"><?php echo $product->price ?>&#8381;</span>
    			    <p class="price">
    			    	<span><?php echo $product->newPrice ?></span>&#8381;
    			    </p>
    			<?php } ?>
    			<?php if ($product->sellerisTrading !== '0' && $product->isInStock !== '0') {
    			            if($product->isAdedToCart == 1) { ?>
        			<span class="svg buttonBuyed toggleModal1">
            			<svg height="24" width="24" style="fill: #f4a137;position: absolute;bottom: 0;right: 0;cursor: pointer;">
            			    <svg viewBox="0 0 24 24">
                                <g fill="#f4a137">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1 2C0.447715 2 0 2.44772 0 3C0 3.55228 0.447715 4 1 4H2.68121C3.08124 4 3.44277 4.2384 3.60035 4.60608L8.44161 15.9023C9.00044 17.2063 10.3963 17.9405 11.7874 17.6623L19.058 16.2082C20.1137 15.9971 20.9753 15.2365 21.3157 14.2151L23.0712 8.94868C23.7187 7.00609 22.2728 5 20.2251 5H5.94511L5.43864 3.81824C4.96591 2.71519 3.88129 2 2.68121 2H1ZM10.2799 15.1145L6.80225 7H20.2251C20.9077 7 21.3897 7.6687 21.1738 8.31623L19.4183 13.5827C19.3049 13.9231 19.0177 14.1767 18.6658 14.247L11.3952 15.7012C10.9315 15.7939 10.4662 15.5492 10.2799 15.1145Z"></path>
                                    <path d="M11 22C11 23.1046 10.1046 24 9 24C7.89543 24 7 23.1046 7 22C7 20.8954 7.89543 20 9 20C10.1046 20 11 20.8954 11 22Z"></path>
                                    <path d="M21 22C21 23.1046 20.1046 24 19 24C17.8954 24 17 23.1046 17 22C17 20.8954 17.8954 20 19 20C20.1046 20 21 20.8954 21 22Z"></path>
                                </g>
                                <g id="icon-basket-filled__fill">
                                    <path d="M20 15L21 6H6L10 16L20 15Z" fill="#f4a137"></path>
                                    <circle cx="17" cy="7" r="7" fill="white"></circle>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17 13C20.3137 13 23 10.3137 23 7C23 3.68629 20.3137 1 17 1C13.6863 1 11 3.68629 11 7C11 10.3137 13.6863 13 17 13ZM20.7071 5.70711C21.0976 5.31658 21.0976 4.68342 20.7071 4.29289C20.3166 3.90237 19.6834 3.90237 19.2929 4.29289L16 7.58579L14.7071 6.29289C14.3166 5.90237 13.6834 5.90237 13.2929 6.29289C12.9024 6.68342 12.9024 7.31658 13.2929 7.70711L15.2929 9.70711C15.6834 10.0976 16.3166 10.0976 16.7071 9.70711L20.7071 5.70711Z" fill="#f4a137"></path>
                                </g>
                            </svg>
            			</svg>
        			</span>
    			<?php       } else { ?>
    			    <span class="svg buttonBuy">
            			<svg height="24" width="24" style="fill: #000;position: absolute;bottom: 0;right: 0;cursor: pointer;">
            			    <svg viewBox="0 0 24 24" id="icon-basket">
                            	<g>
                            		<path fill-rule="evenodd" clip-rule="evenodd" d="M1 2C0.447715 2 0 2.44772 0 3C0 3.55228 0.447715 4 1 4H2.68121C3.08124 4 3.44277 4.2384 3.60035 4.60608L8.44161 15.9023C9.00044 17.2063 10.3963 17.9405 11.7874 17.6623L19.058 16.2082C20.1137 15.9971 20.9753 15.2365 21.3157 14.2151L23.0712 8.94868C23.7187 7.00609 22.2728 5 20.2251 5H5.94511L5.43864 3.81824C4.96591 2.71519 3.88129 2 2.68121 2H1ZM10.2799 15.1145L6.80225 7H20.2251C20.9077 7 21.3897 7.6687 21.1738 8.31623L19.4183 13.5827C19.3049 13.9231 19.0177 14.1767 18.6658 14.247L11.3952 15.7012C10.9315 15.7939 10.4662 15.5492 10.2799 15.1145Z"></path>
                            		<path d="M11 22C11 23.1046 10.1046 24 9 24C7.89543 24 7 23.1046 7 22C7 20.8954 7.89543 20 9 20C10.1046 20 11 20.8954 11 22Z"></path>
                            		<path d="M21 22C21 23.1046 20.1046 24 19 24C17.8954 24 17 23.1046 17 22C17 20.8954 17.8954 20 19 20C20.1046 20 21 20.8954 21 22Z"></path>
                            	</g>
                            </svg>
            			</svg>
        			</span>
    			<?php       }
    			    }   ?>
    		</div>
    	</div>

	</div>
</div>