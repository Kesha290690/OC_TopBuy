public function getLastByProduct($limit,$category_id)
	{
		$query = $this->db->query("SELECT DISTINCT
oh.order_id,
oh.date_added,
op.product_id,
pd.name,
ptc.category_id
FROM oc_order_history oh
LEFT JOIN oc_order_product op
ON op.order_id = oh.order_id
LEFT JOIN oc_product_description pd
ON pd.product_id = op.product_id
LEFT JOIN oc_product_to_category ptc
ON ptc.product_id = op.product_id
WHERE ptc.category_id = '$category_id'
GROUP BY pd.name
ORDER BY oh.date_added DESC
LIMIT $limit");
		return $query->rows;
	}

	public function getLastByProductSpecial($product_id){
		$query = $this->db->query("SELECT
p.image,
p.price,
p.tax_class_id,
ps.price AS 'special'
FROM oc_product p
LEFT JOIN oc_product_special ps
ON ps.product_id = p.product_id
WHERE p.product_id = '$product_id'");
		return $query->rows;
	}