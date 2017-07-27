<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('SpreadSheet.php');
//require_once('mysql.php');
//require_once('log_master.php');

class CI_SpreadSheet {

	protected $sheetid = "";
	protected $prefix ;

	/*! contructor
	 *	@param connection
	 *		mysql connection
	 *	@param sheetid
	 *		id of sheet
	 */
	public function __construct($sheetid='', $prefix='') {
		//$this->connection = $connection;
		//$this->wrapper = new mysql($connection);
		$this->sheetid = $sheetid;
		$this->prefix = $prefix;
	}
	

	/*! sets text by coord
	 *	@param coord
	 *		cell coordinate (string or array)
	 *	@param text
	 *		cell text
	 *	@return
	 *		true if successful or false otherwise
	 */
	public function setText($coord, $text) {
		$cell = $this->getCell($coord);
		return $cell->setText($text);
	}

	/*! get text by coord
	 *	@param coord
	 *		cell coord
	 *	@return
	 *		text if cell exists or false
	 */
	public function getText($coord) {
		$cell = $this->getCell($coord);
		return $cell->getText();
	}

	/*! sets style by coord
	 *	@param coord
	 *		cell coordinate (string or array)
	 *	@param style
	 *		cell associative array or serialized string
	 *	@return
	 *		true if successful or false otherwise
	 */
	public function setStyle($coord, $style) {
		$cell = $this->getCell($coord);
		return $cell->setStyle($style);
	}

	/*! get style by coord
	 *	@param coord
	 *		cell coord
	 *	@return
	 *		style as associative array if cell exists or false
	 */
	public function getStyle($coord) {
		$cell = $this->getCell($coord);
		return $cell->getStyle();
	}

	/*! get cell object by coordinate
	 *	@param coord
	 *		cell coord
	 *	@return
	 *		cell object
	 */
	public function getCell($coord) {
		$cell = new SpreadSheetCell($this->sheetid, $coord, $this->prefix);
		return $cell;
	}

	/*! check if it's correct coordinate
	 *	@param coord
	 *		cell coord
	 *	@return
	 *		cell object or false
	 */
	public function isCell($coord) {
		$cell = new SpreadSheetCell($this->sheetid, $coord, $this->prefix);
		if ($cell->isIncorrect())
			return false;
		return $cell;
	}

	/*! set id of sheet
	 *	@param sheetid
	 *		id of sheet
	 */
	public function setSheetId($sheetid) {
		$this->sheetid = $sheetid;
	}

	/*! get all sheet cells
	 *	@return
	 *		array of cell objects
	 */
	public function getCells() {
		$cells = Array();
		$query = "SELECT `rowid`, `columnid` FROM {$this->prefix}order_data_parameter_pengujian WHERE `sheetid`='{$this->sheetid}'";
		$res = $this->db->query($query);
		//while ($coord = $this->db->next($res)) {
		while ($coord = $this->db->row_array($res)) {
			$cells[] = $this->SpreadSheetCell($this->sheetid, $coord, $this->prefix);
		}
		return $cells;
	}

}
?>
