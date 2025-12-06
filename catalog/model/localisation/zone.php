<?php
class ModelLocalisationZone extends Model {
	public function getZone($zone_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone WHERE zone_id = '" . (int)$zone_id . "' AND status = '1'");

		return $query->row;
	}
	// philip here
	// public function getZonesByCountryId($country_id) {
	// 	$zone_data = $this->cache->get('zone.' . (int)$country_id);

	// 	if (!$zone_data) {
	// 		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone WHERE country_id = '" . (int)$country_id . "' AND status = '1' ORDER BY name");

	// 		$zone_data = $query->rows;

	// 		$this->cache->set('zone.' . (int)$country_id, $zone_data);
	// 	}

	// 	return $zone_data;
	// }
	public function getZonesByCountryId($country_id) {
		$query = $this->db->query("SELECT zone_id, name, name_ar FROM " . DB_PREFIX . "zone WHERE country_id = '" . (int)$country_id . "' AND status = '1' ORDER BY name");
	
		$language = isset($this->session->data['language']) ? $this->session->data['language'] : 'en';
	
		$zones = [];
		foreach ($query->rows as $row) {
			$zone_name = ($language == 'ar' && !empty($row['name_ar'])) ? $row['name_ar'] : $row['name'];
			$zones[] = [
				'zone_id' => $row['zone_id'],
				'name'    => $zone_name
			];
		}
	
		return $zones;
	}
	//end philip here

}