<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\CustomerEntryRequest;
use App\Backend\Infrastructure\Forms\CustomerEditRequest;
use App\Setup\Customer\CustomerRepositoryInterface;
use App\Setup\Customer\Customer;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CustomerController extends Controller
{
    private $CustomerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index(Request $request)
    {
        if (Auth::guard('User')->check()) {
            $customers      = $this->customerRepository->getCustomer();
            return view('customer.index')->with('customers', $customers);
        }
        return redirect('/');
    }

    public function create()
    {
    	if (Auth::guard('User')->check()) {
            return view('customer.customer');
        }
        return redirect('/');
    }
   
    public function store(CustomerEntryRequest $request)
    {
        
        $request->validate();
        $site_url               = Input::get('site_url');
        $max_count              = Input::get('max_count');
        $status                 = Input::get('status');
        $loginID                = session('user');

        $paramObj               = new Customer();
        $paramObj->site_url     = $site_url;
        $paramObj->max_count    = $max_count;
        $paramObj->status       = $status;
        $paramObj->created_by   = $loginID['id'];

        $this->customerRepository->create($paramObj);

        return redirect()->action('CustomerController@index');
    }

    public function edit($id)
    {
         if (Auth::guard('User')->check()) {
            $customer = $this->customerRepository->getObjByID($id);
            return view('customer.customer')->with('customer', $customer);
        }
        return redirect('/');
    }

    public function update(CustomerEditRequest $request)
    {
        $id                  = Input::get('id');
        $site_url            = Input::get('site_url');
        $max_count           = Input::get('max_count');
        $status              = Input::get('status');
        $loginID             = session('user');
        
        $paramObj            = Customer::find($id);
        $paramObj->site_url  = $site_url;
        $paramObj->max_count = $max_count;
        $paramObj->status    = $status;
        $paramObj->updated_by= $loginID['id'];

        $this->customerRepository->update($paramObj);

        return redirect()->action('CustomerController@index');
    }

    public function destroy()
    {

        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->customerRepository->delete($id);
        }
        return redirect()->action('CustomerController@index');
    }

}
