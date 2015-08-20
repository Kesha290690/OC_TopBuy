public function getLastProduct(){
		$this->load->language('product/category');
		$this->load->model('catalog/category');
		$this->load->model('catalog/review');
		$this->load->model('tool/image');

		if (isset($this->request->post['limit']))
		{
			$limit = $this->request->post['limit'];
			$category_id = $this->request->post['category'];
			$json = array();

			$lastAdd = $this->model_catalog_category->getLastByProduct($limit,$category_id);


			$json['sell'] = array();
			foreach($lastAdd as $descript)
			{

				$for_prices = $this->model_catalog_category->getLastByProductSpecial($descript['product_id']);

				foreach($for_prices as $for_price)
				{
					$json['price']   = $for_price['price'];
					$json['special'] = $for_price['special'];
					$json['image']   = $for_price['image'];
					$json['tax']     = $for_price['tax_class_id'];
				}

				if($json['special']){
					$json['special'] = $this->currency->format($this->tax->calculate($json['special'], $json['tax'], $this->config->get('config_tax')));
				} else {
					$json['special'] = false;
				}

				$json['sell'][] = array(
					'date_added' 		=> $descript['date_added'],
					'name'       		=> $descript['name'],
					'order_id'   		=> $descript['order_id'],
					'product_id' 		=> $descript['product_id'],
					'category_id'		=> $descript['category_id'],
					'total_review'		=> (int)$this->model_catalog_review->getTotalReviewsByProductId($descript['product_id']),
					'review' 			=> $this->model_catalog_review->getReviewsByProductId($descript['product_id']),
					'price'             => $this->currency->format($this->tax->calculate($json['price'], $json['tax'], $this->config->get('config_tax'))),
					'special'           => $json['special'],
					'image'             => $this->model_tool_image->resize($json['image'], 200, 200),
				);


			}

			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));

		}
	}