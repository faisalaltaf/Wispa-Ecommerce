$sql = "SELECT product.* , categories.categories from product, categories where product.categories_id = categories.id order by product.id desc";
