<?php

namespace App\Http\Controllers\Migration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Hash;

class UserController extends Controller
{
    public function __construct(User $User)
    {
    	$this->BaseModel = $User;
    }


    public function updatePassword(Request $request,$auth = FALSE)
    {	

    	switch ($auth) 
    	{
    		case 'akash':
    			self::handle($request);
			break;
    		
    		default:
    			return back();
			break;
    	}
    }

    public function handle($request)
    {
        dump('Script started');

    	$collections = $this->BaseModel->all();
    	if (!$collections->isEmpty()) 
    	{	

    		foreach ($collections as $key => $collection) 
    		{
                if (!empty($collection->str_password)) 
    			{
                    $tmp = [];
    				$tmp['password'] = Hash::make(trim($collection->str_password));	
    				$obj = $this->BaseModel->where('id', $collection->id)->update($tmp);
                    dump('Password generated for email - '. $collection->email);
    			}	
    		}
    	}

    	dd('Script completed');
    }
}
