<?php
/*
 * Ajax.php
 * 
 * Copyright 2016 Isnu Suntoro <isnusun@isnusun-X450LCP>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Jsphp extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('siteman_model');
		$this->load->model('lembaga_model');
	}
	   
  public function index(){
		echo "Hello World";
	}
	public function jqueryValidationEngineId(){
		$this->output->set_header('Content-type: text/javascript');
		echo '
		(function($){
				$.fn.validationEngineLanguage = function(){
				};
				$.validationEngineLanguage = {
						newLang: function(){
								$.validationEngineLanguage.allRules = {
										"required": { // Add your regex rules here, you can take telephone as an example
												"regex": "none",
												"alertText": "* Kolom ini wajib",
												"alertTextCheckboxMultiple": "* Silahkan pilih pilihan",
												"alertTextCheckboxe": "* Kotak centang ini wajib",
												"alertTextDateRange": "* Kedua Kolom rentang tanggal ini wajib"
										},
										"requiredInFunction": { 
												"func": function(field, rules, i, options){
														return (field.val() == "test") ? true : false;
												},
												"alertText": "* Kolom harus sama dengan uji"
										},
										"dateRange": {
												"regex": "none",
												"alertText": "* Rentang Tanggal ",
												"alertText2": "Tidak Sah"
										},
										"dateTimeRange": {
												"regex": "none",
												"alertText": "* Rentang Tanggal Waktu ",
												"alertText2": "Tidak Sah"
										},
										"minSize": {
												"regex": "none",
												"alertText": "* Minimum ",
												"alertText2": " karakter yang dibutuhkan"
										},
										"maxSize": {
												"regex": "none",
												"alertText": "* Maksimum ",
												"alertText2": " karakter yang dibutuhkan"
										},
										"groupRequired": {
												"regex": "none",
												"alertText": "* Anda harus mengisi salah satu Kolom berikut"
										},
										"min": {
												"regex": "none",
												"alertText": "* Nilai minimalnya adalah "
										},
										"max": {
												"regex": "none",
												"alertText": "* Nilai maksimum adalah "
										},
										"past": {
												"regex": "none",
												"alertText": "* Tanggal sebelum "
										},
										"future": {
												"regex": "none",
												"alertText": "* Tanggal sesudah "
										},    
										"maxCheckbox": {
												"regex": "none",
												"alertText": "* Maksimum ",
												"alertText2": " pilihan yang diperbolehkan"
										},
										"minCheckbox": {
												"regex": "none",
												"alertText": "* Silahkan pilih ",
												"alertText2": " pilihan"
										},
										"equals": {
												"regex": "none",
												"alertText": "* Isian kolom tidak sama"
										},
										"creditCard": {
												"regex": "none",
												"alertText": "* Nomor kartu kredit tidak sah"
										},
										"phone": {
												// credit: jquery.h5validate.js / orefalo
												"regex": /^([\+][0-9]{1,3}([ \.\-])?)?([\(][0-9]{1,6}[\)])?([0-9 \.\-]{1,32})(([A-Za-z \:]{1,11})?[0-9]{1,4}?)$/,
												"alertText": "* Nomor telepon tidak sah"
										},
										"email": {
												// HTML5 compatible email regex ( http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#    e-mail-state-%28type=email%29 )
												"regex": /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
												"alertText": "* Alamat email tidak sah"
										},
										"integer": {
												"regex": /^[\-\+]?\d+$/,
												"alertText": "* Bukan bilangan bulat yang sah"
										},
										"number": {
												// Number, including positive, negative, and floating decimal. credit: orefalo
												"regex": /^[\-\+]?((([0-9]{1,3})([,][0-9]{3})*)|([0-9]+))?([\.]([0-9]+))?$/,
												"alertText": "* Bukan angka desimal mengambang yang sah"
										},
										"date": {
												//    Check if date is valid by leap year
												"func": function (field) {
														var pattern = new RegExp(/^(\d{4})[\/\-\.](0?[1-9]|1[012])[\/\-\.](0?[1-9]|[12][0-9]|3[01])$/);
														var match = pattern.exec(field.val());
														if (match == null)
														 return false;
										
														var year = match[1];
														var month = match[2]*1;
														var day = match[3]*1;            
														var date = new Date(year, month - 1, day); // because months starts from 0.
										
														return (date.getFullYear() == year && date.getMonth() == (month - 1) && date.getDate() == day);
												},                    
												 "alertText": "* Tanggal tidak sah, harus dalam format TTTT-BB-HH"
										},
										"ipv4": {
												"regex": /^((([01]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))[.]){3}(([0-1]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))$/,
												"alertText": "* Alamat IP tidak sah"
										},
										"onlyNumberSp": {
												"regex": /^[0-9\ ]+$/,
												"alertText": "* Angka saja"
										},
										"onlyDecimal": {
											// Number, including positive, negative, and floating decimal. credit: orefalo
											"regex": /^[\-\+]?(([0-9]+)([\.,]([0-9]+))?|([\.,]([0-9]+))?)$/,
											"alertText": "* Isikan dengan angka desimal yang benar!"
										},                
										"onlyLetterSp": {
												"regex": /^[a-zA-Z\ \']+$/,
												"alertText": "* Huruf saja"
										},
										"onlyLetterAccentSp":{
												"regex": /^[a-z\u00C0-\u017F\ ]+$/i,
												"alertText": "* Huruf saja"
										},
										"onlyLetterNumber": {
												"regex": /^[0-9a-zA-Z]+$/,
												"alertText": "* Karakter khusus tidak diperbolehkan. Hanya huruf dan angka saja"
										},
										// --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
										"ajaxUser": {
												"url": "'.site_url("/ajax/siteman_periksa_username/?").'",
												"alertTextOk": "* Username ini tersedia",
												"alertText": "* Username ini sudah digunakan",
												"alertTextLoad": "* Sedang memeriksa, silahkan tunggu"
										},
										"ajaxUserEmail": {
												"url": "'.site_url("/ajax/siteman_periksa_email/?").'",
												"alertTextOk": "* Alamat Email ini tersedia",
												"alertText": "* Alamat EMail ini sudah digunakan",
												"alertTextLoad": "* Sedang memeriksa, mohon menunggu"
										},
										"validate2fields": {
												"alertText": "* Silakan masukan HELLO"
										},
										//tls warning:homegrown not fielded 
										"dateFormat":{
												"regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:0?[1-9]|1[0-2])(\/|-)(?:0?[1-9]|1\d|2[0-8]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(0?2(\/|-)29)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$/,
												"alertText": "* Tanggal Tidak Sah"
										},
										//tls warning:homegrown not fielded 
										"dateTimeFormat": {
												"regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])\s+([01]?[0-9]|2[0-3]){1}:(0?[1-5]|[0-5][0-9]){1}:(0?[0-6]|[0-5][0-9]){1}$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^((1[012]|0?[1-9]){1}\/(0?[1-9]|[12][0-9]|3[01]){1}\/\d{2,4}\s+([01]?[0-9]|2[0-3]){1}:(0?[1-5]|[0-5][0-9]){1}:(0?[0-9]|[0-5][0-9]){1})$/,
												"alertText": "* Tanggal atau Format Tanggal Tidak Sah",
												"alertText2": "Format yang diharapkan: ",
												"alertText3": "bb/hh/tttt jj:mm:dd atau ",
												"alertText4": "tttt-bb-hh jj:mm:dd"
										},
								}
						}
				};

				$.validationEngineLanguage.newLang();
				
		})(jQuery);
		
		';
	}
}
