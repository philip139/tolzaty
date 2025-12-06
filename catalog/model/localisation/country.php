<?php
class ModelLocalisationCountry extends Model {
	public function getCountry($country_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$country_id . "' AND status = '1'");

		return $query->row;
	}

	//philip here
	// public function getCountries() {
	// 	$country_data = $this->cache->get('country.catalog');

	// 	if (!$country_data) {
	// 		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE status = '1' ORDER BY name ASC");

	// 		$country_data = $query->rows;

	// 		$this->cache->set('country.catalog', $country_data);
	// 	}

	// 	return $country_data;
	// }
	public function getCountries() {
		$query = $this->db->query("SELECT country_id, name, name_ar FROM " . DB_PREFIX . "country WHERE status = '1' ORDER BY name");
	
		$language = isset($this->session->data['language']) ? $this->session->data['language'] : 'en';
		
		$countries = [];
		foreach ($query->rows as $row) {
			$country_name = ($language == 'ar' && !empty($row['name_ar'])) ? $row['name_ar'] : $row['name'];
			$countries[] = [
				'country_id' => $row['country_id'],
				'name'       => $country_name
			];
		}
	
		return $countries;
	}
	//end philip here

}