
 var cities = {
	'Accra'  : [
		"Accra New Town",
"Achimota",
"Ada Foah",
"Ada Kasseh",
"Adabraka",
"Adenta",
"Adenta East",
"Adjei Kojo",
"Adjen Kotoku",
"Airport City Accra",
"Airport Residential Area",
"Akweteyman",
"Alajo",
"Ngleshie Amanfro",
"Amasaman",
"Apenkwa",
"Ashaiman",
"Ashongman",
"Asoprochona",
"Awoshie",
"Ayi Mensa",
"Bansa",
"Big Ada",
"Bubuashi",
"Bubuashie",
"Bukom",
"Cantonments, Accra",
"Caprice, Ghana",
"Chorkor",
"Christian Village",
"Dansoman",
"Darkuman",
"Dawhenya",
"Dodowa",
"Dome, Ghana",
"Dzorwulu",
"East Legon",
"Eleme",
"Frafraha",
"Gbawe",
"Gbegbe",
"Haatso",
"Kaneshie",
"Kisseman",
"Kokomlemle",
"Kokrobite",
"Korle Gonno",
"Kotobabi",
"Kuntunse",
"Kwabenya",
"Kwashieman",
"Labadi",
"Labone, Accra",
"Lapaz (Accra)",
"Lartebiokorshie",
"Lashibi",
"Lebanon, Ashaiman",
"Legon",
"Maamobi",
"Madina",
"Makola",
"Mallam",
"Mamprobi",
"Mataheko",
"Miotso",
"Nii Boi Town",
"Nima, Accra",
"Nmai Dzorn",
"North Industrial Area, Accra",
"Nungua",
"Odorkor",
"Ogbodjo",
"Old Ningo",
"Oyarifa",
"Pantang",
"Pig Farm (Ghana)",
"Pokuase, Ghana",
"Prampram",
"Sabon Zongo",
"Sakaman",
"Sakumono",
"Santeo",
"Sege (town)",
"Shai Hills",
"Shiashie",
"Sowutuom",
"Sugbaniate",
"Swalaba",
"Taifa, Accra",
"Tema",
"Tema Community 1",
"Tema Community 4",
"Tema Community 5",
"Tema Manhean",
"Tesano",
"Teshie",
"Teshie-Nungua",
"Torkuase",
"Tudu",
"Weija"
		],
 }

 var City = function() {

	this.p = [],this.c = [],this.a = [],this.e = {};
	window.onerror = function() { return true; }
	
	this.getProvinces = function() {
		for(let province in cities) {
			this.p.push(province);
		}
		return this.p;
	}
	this.getCities = function(province) {
		if(province.length==0) {
			console.error('Please input province name');
			return;
		}
		for(let i=0;i<=cities[province].length-1;i++) {
			this.c.push(cities[province][i]);
		}
		return this.c;
	}
	this.getAllCities = function() {
		for(let i in cities) {
			for(let j=0;j<=cities[i].length-1;j++) {
				this.a.push(cities[i][j]);
			}
		}
		this.a.sort();
		return this.a;
	}
	this.showProvinces = function(element) {
		var str = '<option selected disabled>Select Province</option>';
		for(let i in this.getProvinces()) {
			str+='<option>'+this.p[i]+'</option>';
		}
		this.p = [];		
		document.querySelector(element).innerHTML = '';
		document.querySelector(element).innerHTML = str;
		this.e = element;
		return this;
	}
	this.showCities = function(province,element) {
		var str = '<option selected disabled>Select City / Municipality</option>';
		var elem = '';
		if((province.indexOf(".")!==-1 || province.indexOf("#")!==-1)) {
			elem = province;
		}
		else {
			for(let i in this.getCities(province)) {
				str+='<option>'+this.c[i]+'</option>';
			}
			elem = element;
		}
		this.c = [];
		document.querySelector(elem).innerHTML = '';
		document.querySelector(elem).innerHTML = str;
		document.querySelector(this.e).onchange = function() {		
			var Obj = new City();
			Obj.showCities(this.value,elem);
		}
		return this;
	}
}
