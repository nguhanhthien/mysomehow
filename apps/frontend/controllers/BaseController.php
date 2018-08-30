<?php
namespace Mysomwhow\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Models\Categories;
use Models\Products;
use Models\Setting;
use Models\Slides;

class BaseController extends Controller
{

    public function initialize()
    {
    	$categories = Categories::find();
        $this->view->setVar('categories', $categories);

        $setting = Setting::findfirst();
        $this->view->setVar('setting', $setting);

        $slides = Slides::find();
        $this->view->setVar('slides', $slides);

        //check autocomplete
        $term = $this->request->getQuery('term');

        if ($term) {
            $key = $term;
        }else{
            $key = $this->request->getQuery('search');
        }

        if (!is_null($key)) {
            $data_search = Products::find([
                ['title' => ['$regex' => mb_strtoupper(trim($key))]],
            ]);

            //load data
            if ($term) {
                $result = array();
		        foreach ($data_search as $data_search) {
		            array_push($result, array(
		                'id' => $data_search->_id,
		                'value' => $data_search->title,
		            ));
		        }
		        die(json_encode($result));
            }else{
            	$this->response->redirect('search/'.$key);
            }
        }
    }

}

