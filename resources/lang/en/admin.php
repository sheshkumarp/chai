<?php 

return [

	/*--------------------------------------
	|	Module name LOGIN
	-------------------------------------------------------------------*/

		// ERROR MESSAGES
				
		'ERR_USERNAME_REQUIRED' 	=> "Username field is required.",
		'ERR_PASSWORD_REQUIRED' 	=> "Password field is required.",

		'TITLE_USERNAME' 		=> 'Username',
		'TITLE_PASSWORD' 		=> 'Password',
		'TITLE_REMEMBER_ME' 	=> 'Remember me',
		'TITLE_FORGOT_PASSWORD' => 'Forgot Password',

		'BUTTON_LOGIN' 			=> 'Login',


	/*--------------------------------------
	|	Module name USERS
	-------------------------------------------------------------------*/
	
		// Errors
		'ERR_FIRST_NAME' 	=> "First name field is required.",
		'ERR_LAST_NAME' 	=> "Last name field is required.",
		'ERR_EMAIL_NAME' 	=> "Email field is required.",
		'ERR_EMAIL_FORMAT' 	=> "Email format is invalid.",
		'ERR_EMAIL_DUP' 	=> "Email has already taken.",
		'ERR_PASS' 			=> "Password field is required.",
		'ERR_PASS_MIN_SIZE' => "Password should be minimum 6 character long.",
		'ERR_CONFIRM_PASS' 	=> "Confirm password field is required.",
		'ERR_COMPARE_PASS' 	=> "Confirm password not match with password.",
		'ERR_ROLE' 			=> "Role field is required.",

		// Titles
		'TITLE_FIRST_NAME'  => 'First Name',
		'TITLE_LAST_NAME'  	=> 'Last Name',
		'TITLE_EMAIL'  		=> 'Email Address',
		'TITLE_PASS'  		=> 'Password',
		'TITLE_CONFIRM_PASS'=> 'Confirm Password',
		'TITLE_SELECT_ROLE'	=> 'Select Role',
		'TITLE_SUBMIT_BUTTON'=> 'Save',
		'TITLE_SUBMIT_CHANGES_BUTTON'=> 'Save Changes',
		'TITLE_ADD_USER_BUTTON'=> 'Add New User',

		// Response status
		'RESP_SUCCESS' 	=> 'success',
		'RESP_ERROR' 	=> 'error',
		'RESP_WARNING' 	=> 'warning',
		'RESP_INFO' 	=> 'info',

		// Response messages
		'USER_CREATED' 	=> 'User created successfully.',
		'USER_UPDATED' 	=> 'User updated successfully.',
		'USER_DELETED' 	=> 'User deleted successfully.',
		'USER_STATUS_CHANGED' => 'User status changed successfully.',

		// Response error
		'FAIL_USER_CREATE' 	=> 'Failed to create user, Something went wrong on server.',
		'FAIL_USER_UPDATE' 	=> 'Failed to update user, Something went wrong on server.',
		'FAIL_USER_DELETE' 	=> 'Failed to delete user, Something went wrong on server.',
		'FAIL_USER_STATUS_CHANGE' => 'Failed to change user status, Something went wrong on server.',

	/*--------------------------------------
	|	Module name CREDITS
	-------------------------------------------------------------------*/
		// Errors
		'ERR_TYPE' 				=> "Credit Type field is required.",
		'ERR_HEXCODE' 			=> "Enter valid Hex Code.",
		
		// Response messages
		'CREDIT_CREATED' 		=> 'Credit type created successfully.',
		'CREDIT_UPDATED' 		=> 'Credit type updated successfully.',
		'CREDIT_DELETED' 		=> 'credit types deleted successfully.',		

		// Response error
		'FAIL_CREDIT_CREATE' 	=> 'Failed to create credit type, Something went wrong on server.',
		'FAIL_CREDIT_UPDATE' 	=> 'Failed to update credit type, Something went wrong on server.',
		'FAIL_CREDIT_DELETE' 	=> 'Failed to delete credit type, Something went wrong on server.',

	/*--------------------------------------
	|	Module name FAQ CATEGORY
	-------------------------------------------------------------------*/
		// Titles
		''  => '',
		'CAT_SUBTITLE'  	=> 'Category Information',

		// Errors
		'ERR_CAT_TITLE' 	=> "Category Title field is required.",
		
		// Response messages
		'CATEGORY_CREATED' 	=> 'Category created successfully.',
		'CATEGORY_UPDATED' 	=> 'Category updated successfully.',
		'CATEGORY_DELETED' 	=> 'Category deleted successfully.',
		'CATEGORY_STATUS_CHANGED' => 'Category status changed successfully.',

		// Response error
		'FAIL_CATEGORY_CREATE' 	=> 'Failed to create category, Something went wrong on server.',
		'FAIL_CATEGORY_UPDATE' 	=> 'Failed to update category, Something went wrong on server.',
		'FAIL_CATEGORY_DELETE' 	=> 'Failed to delete category, Something went wrong on server.',
		'FAIL_CATEGORY_STATUS_CHANGE' => 'Failed to change category status, Something went wrong on server.',

	/*--------------------------------------
	|	Module name Homepage
	-------------------------------------------------------------------*/

		// Errors
		'ERR_AUTHOR_NAME' 	=> "Author name field is required.",
		'ERR_AUTHOR_FIRM' 	=> "Author firm field is required.",
		'ERR_AUTHOR_TEXT' 	=> "Author text field is required.",
		
		// Titles
		'TITLE_AUTHOR_NAME'  => 'Author Name',
		'TITLE_AUTHOR_FIRM'  => 'Author Firm/Company',
		'TITLE_AUTHOR_TEXT'  => 'Testimonial Text',
		
		// Response messages
		'TESTIMONIALS_CREATED' 	=> 'Testimonials created successfully.',
		'TESTIMONIALS_UPDATED' 	=> 'Testimonials updated successfully.',
		'TESTIMONIALS_DELETED' 	=> 'Testimonials deleted successfully.',
		'TESTIMONIALS_STATUS_CHANGED' => 'Testimonials status changed successfully.',

		// Response error
		'FAIL_TESTIMONIALS_CREATE' 	=> 'Failed to create Testimonials, Something went wrong on server.',
		'FAIL_TESTIMONIALS_UPDATE' 	=> 'Failed to update Testimonials, Something went wrong on server.',
		'FAIL_TESTIMONIALS_DELETE' 	=> 'Failed to delete Testimonials, Something went wrong on server.',
		'FAIL_TESTIMONIALS_STATUS_CHANGE' => 'Failed to change Testimonials status, Something went wrong on server.',

	/*--------------------------------------
	|	Module name STATE
	-------------------------------------------------------------------*/
	
		// Errors
		'ERR_STATE' 			=> "State field is required.",
		'ERR_STATE_CLE_PRICE_FORMAT' 	=> "Unlimited CLE Price should be integer.",	
		// Response messages
		'STATE_CREATED' 		=> 'State created successfully.',
		'STATE_UPDATED' 		=> 'State updated successfully.',
		'STATE_DELETED' 		=> 'State deleted successfully.',		

		// Response error
		'FAIL_STATE_CREATE' 	=> 'Failed to create state, Something went wrong on server.',
		'FAIL_STATE_UPDATE' 	=> 'Failed to update state, Something went wrong on server.',
		'FAIL_STATE_DELETE' 	=> 'Failed to delete state, Something went wrong on server.',

	/*--------------------------------------
	|	Module name UNLIMITE CLE
	-------------------------------------------------------------------*/
	
		// Errors
		'ERR_UNLIMITEDCLE' 			=> "Unlimited cle title field is required.",
		'ERR_PRICE' 				=> "Please enter price.",
		'ERR_STATE' 				=> "Please enter plan state.",
		'ERR_PRICE_FORMAT' 			=> "Price should be in integer.",
		'ERR_PREVIOUSPRICE_FORMAT'	=> "Previous Price should be in integer.",

		// Response messages
		'UNLIMITEDCLE_CREATED' 		=> 'Unlimited CLE plan created successfully.',
		'UNLIMITEDCLE_UPDATED' 		=> 'Unlimited CLE plan updated successfully.',
		'UNLIMITEDCLE_INACTIVE' 	=> 'Unlimited CLE plan status changed successfully.',
		'UNLIMITEDCLE_FCOURSES' 	=> 'Feature courses added successfully.',		
		'UNLIMITEDCLE_DELETE' 	    => 'Unlimited CLE plan deleted successfully.',		

		// Response error
		'FAIL_UNLIMITEDCLE_CREATE' 	=> 'Failed to create Unlimited CLE plan, Something went wrong on server.',
		'FAIL_UNLIMITEDCLE_UPDATE' 	=> 'Failed to update Unlimited CLE plan, Something went wrong on server.',
		'FAIL_UNLIMITEDCLE_DELETE' 	=> 'Failed to delete Unlimited CLE plan, Something went wrong on server.',
		'FAIL_UNLIMITEDCLE_FCOURSES'=> 'Failed to create feature courses, Something went wrong on server.',

	/*--------------------------------------
	|	Module name USERS
	-------------------------------------------------------------------*/

		'ERR_FIRST_NAME_REGEX'       => 'First name should accept latter\'s and numbers only.',
        'ERR_LAST_NAME_REGEX'        => 'Last name should accept latter\'s and numbers only.',
        'ERR_PHONE_REGEX'          	 => 'Phone field format is invalid.',
        'ERR_PHONE_REQUIRED'      	 => 'Phone field is required.',
        'ERR_FIRM_NAME_REQUIRED'     => 'Firm name field is required.',
        'ERR_WEBSITE_REQUIRED'       => 'Website field is required.',
        'ERR_WEBSITE_URL'            => 'Website URL format is invalid.',
        'ERR_ABOUT_LECTURE_REQUIRED' => 'About lecture field is required.',
		'ERR_PRACTICE_AREA___NAME'   => 'Practice area field is required.',
		
	/*--------------------------------------
	|	Module name Live Bundle
	-------------------------------------------------------------------*/
	
		// Errors
		'ERR_LIVEBUNDLE_TITLE' 			    => "Live Bundle title is required.",
		'ERR_LIVEBUNDLE_PRICE' 				=> "Live Bundle price is required.",
		'ERR_LIVEBUNDLE_PRICE_FORMAT' 	=> "Live Bundle price should be integer.",	
		'ERR_LIVEBUNDLE_PERVIOUS_PRICE_FORMAT' 	=> "Live Bundle previous price should be integer.",	
		'ERR_LIVEBUNDLE_STATE' 				=> "Please select state.",
		'ERR_LIVEBUNDLE_CREDIT' 			=> 'Credit value should be numeric.',

		// Response messages
		'LIVEBUNDLE_CREATED' 		=> 'Live Bundle created successfully.',
		'LIVEBUNDLE_UPDATED' 		=> 'Live Bundle updated successfully.',
		'LIVEBUNDLE_DELETED' 	    => 'Live Bundle deleted successfully.',	

		// Response error
		'FAIL_LIVEBUNDLE_CREATE' 	=> 'Failed to create Live Bundle, Something went wrong on server.',
		'FAIL_LIVEBUNDLE_UPDATE' 	=> 'Failed to update Live Bundle, Something went wrong on server.',
		'FAIL_LIVEBUNDLE_DELETE' 	=> 'Failed to delete Live Bundle, Something went wrong on server.',


/*--------------------------------------
	|	Module name Front End
	-------------------------------------------------------------------*/
			
		// Response status
		'WEB_RESP_SUCCESS' 	=> 'success',
		'WEB_RESP_ERROR' 	=> 'error',
		'WEB_RESP_WARNING' 	=> 'warning',
		'WEB_RESP_INFO' 	=> 'info',		


    /*--------------------------------------
	|	Module name Banner
	-------------------------------------------------------------------*/
	
		// Errors
		'ERR_TITLE' 			=> "Banner field is required.",
		'ERR_TEXT' 				=> "Banner text is required.",

		// Response messages
		'BANNER_CREATED' 		    => 'Banner created successfully.',
		'BANNER_UPDATED' 			=> 'Banner updated successfully.',
		'BANNER_DELETED' 			=> 'Banner deleted successfully.',
		
		// Response error
		'FAIL_BANNER_CREATE' 	=> 'Failed to create Banner, Something went wrong on server.',
		'FAIL_BANNER_UPDATE' 	=> 'Failed to update Banner, Something went wrong on server.',
		'FAIL_BANNER_DELETE' 	=> 'Failed to delete Banner, Something went wrong on server.',
		

	/*--------------------------------------
	|	Module name Coupons
	-------------------------------------------------------------------*/
	
		// Errors
		'ERR_COUPONS_TITLE' 			=> "Coupon title is required.",
		'ERR_COUPONS_CODE' 				=> "Coupon code is required.",
		'ERR_COUPONS_TYPE' 				=> "Coupon type is required.",
		'ERR_COUPONS_VALUE' 			=> "Coupon value should be proper.",
		'ERR_COUPONS_DATE' 			    => "Expire date is required.",
		

		// Response messages
		'COUPONS_CREATED' 		    => 'Coupons created successfully.',
		'COUPONS_UPDATED' 			=> 'Coupons updated successfully.',
		'COUPONS_DELETED' 			=> 'Coupons deleted successfully.',
		
		// Response error
		'FAIL_COUPONS_CREATE' 	=> 'Failed to create Coupons, Something went wrong on server.',
		'FAIL_COUPONS_UPDATE' 	=> 'Failed to update Coupons, Something went wrong on server.',
		'FAIL_COUPONS_DELETE' 	=> 'Failed to delete Coupons, Something went wrong on server.',


    /*--------------------------------------
	|	Module name Tutorials
	-------------------------------------------------------------------*/
	
		// Errors
		'ERR_TITLE' 			=> "Title is required.",
		'ERR_CODE' 				=> "Code is required.",
		'ERR_ORDER' 			=> "Order is required.",

		// Response messages
		'VIDEOS_CREATED' 		    => 'Videos created successfully.',
		'VIDOES_UPDATED' 			=> 'Videos updated successfully.',		
		
		// Response error
		'FAIL_VIDEOS_CREATE' 	=> 'Failed to create Videos, Something went wrong on server.',
		'FAIL_VIDEOS_UPDATE' 	=> 'Failed to update Videos, Something went wrong on server.',		
		
	/*--------------------------------------
	|	Module name Live Lecture
	-------------------------------------------------------------------*/
	
		// Errors
		'ERR_LIVELECTURE_TITLE' 			    => "Live Lecture title is required.",
		'ERR_LIVELECTURE_PRICE' 				=> "Live Lecture price is required.",
		'ERR_LIVELECTURE_LOCATION' 				=> "Live Lecture location is required.",
		'ERR_LIVELECTURE_PRICE_FORMAT' 	=> "Live Lecture price should be integer.",	
		'ERR_LIVELECTURE_PERVIOUS_PRICE_FORMAT' 	=> "Live Lecture previous price should be integer.",	
		'ERR_LIVELECTURE_STATE' 				=> "Please select state.",
		'ERR_LIVELECTURE_CREDIT' 			=> 'Credit value should be numeric.',

		// Response messages
		'LIVELECTURE_CREATED' 		=> 'Live Lecture created successfully.',
		'LIVELECTURE_UPDATED' 		=> 'Live Lecture updated successfully.',
		'LIVELECTURE_DELETED' 	    => 'Live Lecture deleted successfully.',	

		// Response error
		'FAIL_LIVELECTURE_CREATE' 	=> 'Failed to create Live Lecture, Something went wrong on server.',
		'FAIL_LIVELECTURE_UPDATE' 	=> 'Failed to update Live Lecture, Something went wrong on server.',
		'FAIL_LIVELECTURE_DELETE' 	=> 'Failed to delete Live Lecture, Something went wrong on server.',

		/*--------------------------------------
		|	Course
		-------------------------------------------------------------------*/

		// Errors
		'ERR_COURSE_TITLE' 			    => "Course title field is required.",
		'ERR_COURSE_PRICE' 			    => "Course price field is required.",
		'ERR_COURSE_PRICE_INVALID'	    => "Please enter price in valid format.",

		/*--------------------------------------
		|	Customer
		-------------------------------------------------------------------*/

		// Response messages
		'CUSTOMER_CREATED' 		=> 'Customer created successfully.',
		'CUSTOMER_UPDATED' 		=> 'Customer updated successfully.',
		'CUSTOMER_DELETED' 	    => 'Customer deleted successfully.',	
		'ERR_CUSTOMER_DELETED' 	    => 'Can\'t delete current logged user',	



		// Order Response messages
		'ORDERS_CREATED' 		=> 'Order created successfully.',
		'ORDERS_UPDATED' 		=> 'Order updated successfully.',
		'ORDERS_DELETED' 	    => 'Order deleted successfully.',	
];