<?php

/**
 * Various definitions of search parameter options available
 * through the Zanox Web Services API
 *
 */

/**
 * Publisher ad spaces
 */
$ZS_ad_spaces = array ();

/**
 * Zanox sales region definitions
 */
$ZS_sales_regions = array (
	"ALL" => "All sales regions",
	"AD" => "Andorra",
	"AE" => "United Arab Emirates",
	"AG" => "Antigua and Barbuda",
	"AR" => "Argentina",
	"AT" => "Austria",
	"AU" => "Australia",
	"BE" => "Belgium",
	"BG" => "Bulgaria",
	"BH" => "Bahrain",
	"BO" => "Bolivia",
	"BR" => "Brazil",
	"BZ" => "Belize",
	"CA" => "Canada",
	"CH" => "Switzerland",
	"CL" => "Chile",
	"CN" => "China",
	"CO" => "Colombia",
	"CR" => "Costa Rica",
	"CU" => "Cuba",
	"CY" => "Cyprus",
	"CZ" => "Czech Republic",
	"DE" => "Germany",
	"DK" => "Denmark",
	"DO" => "Dominican Republic",
	"EC" => "Ecuador",
	"EE" => "Estonia",
	"EG" => "Egypt",
	"ES" => "Spain",
	"FI" => "Finland",
	"FR" => "France",
	"GB" => "United Kingdom",
	"GF" => "French Guiana",
	"GP" => "Guadeloupe",
	"GR" => "Greece",
	"GT" => "Guatemala",
	"HK" => "Hong Kong",
	"HN" => "Honduras",
	"HR" => "Croatia",
	"HU" => "Hungary",
	"ID" => "Indonesia",
	"IE" => "Ireland",
	"IL" => "Israel",
	"IN" => "India",
	"IS" => "Iceland",
	"IT" => "Italy",
	"JP" => "Japan",
	"KR" => "Korea, Republic of",
	"KW" => "Kuwait",
	"LI" => "Liechtenstein",
	"LT" => "Lithuania",
	"LU" => "Luxembourg",
	"LV" => "Latvia",
	"MC" => "Monaco",
	"MD" => "Moldova, Republic of",
	"MQ" => "Martinique",
	"MT" => "Malta",
	"MX" => "Mexico",
	"MY" => "Malaysia",
	"NI" => "Nicaragua",
	"NL" => "Netherlands",
	"NO" => "Norway",
	"NZ" => "New Zealand",
	"PA" => "Panama",
	"PE" => "Peru",
	"PF" => "French Polynesia",
	"PH" => "Philippines",
	"PL" => "Poland",
	"PM" => "Saint Pierre and Miquelon",
	"PT" => "Portugal",
	"PY" => "Paraguay",
	"QA" => "Qatar",
	"RE" => "Reunion Réunion",
	"RO" => "Romania",
	"RU" => "Russian Federation",
	"RW" => "Rwanda",
	"SA" => "Saudi Arabia",
	"SE" => "Sweden",
	"SG" => "Singapore",
	"SI" => "Slovenia",
	"SK" => "Slovakia",
	"SM" => "San Marino",
	"SV" => "El Salvador",
	"TF" => "French Southern Territories",
	"TH" => "Thailand",
	"TR" => "Turkey",
	"TW" => "Taiwan, Province of China",
	"UA" => "Ukraine",
	"US" => "United States",
	"UY" => "Uruguay",
	"VA" => "Holy See (Vatican City State)",
	"VC" => "Saint Vincent and the Grenadines",
	"VE" => "Venezuela, Bolivarian Republic of",
	"YT" => "Mayotte",
	"ZA" => "South Africa"
);



/**
 * Zanox product categories
 */
$ZS_product_categories = array (
	"0" 	=> "All product categories",
	"10000" => "Cars & Motorcycles",
	"10200" => "Used Vehicles",
	"10205" => "Other Vehicles",
	"10203" => "Motorcycles",
	"10202" => "Commercial Vehicles",
	"10204" => "Caravans & Motor Homes",
	"10201" => "Cars",
	"10500" => "Leasing",
	"10502" => "Commercial Vehicles",
	"10504" => "Caravans & Motor Homes",
	"10501" => "Cars",
	"10503" => "Motorcycles",
	"10505" => "Other Vehicles",
	"10300" => "Accessories and Parts",
	"10306" => "Motorcycle Accessories",
	"10305" => "Spare Parts",
	"10301" => "Auto Accessories",
	"10302" => "Car Hi-Fis & In-Car Entertainment",
	"10304" => "Tyres & Wheel Rims",
	"10303" => "Navigation",
	"10100" => "New Vehicles",
	"10103" => "Motorcycles",
	"10104" => "Caravans & Motor Homes",
	"10102" => "Commercial Vehicles",
	"10101" => "Cars",
	"10105" => "Miscellaneous Vehicles",

	"20000" => "Beauty & Health",
	"20700" => "Eyeglasses",
	"20800" => "Medical Appliances",
	"20500" => "Medications",
	"20300" => "Hair Care",
	"20200" => "Personal Grooming",
	"20600" => "Toiletries",
	"20400" => "Perfume",
	"20100" => "Cosmetics",

	"30000" => "Fashion & Accessories",
	"30700" => "Childrenswear",
	"30709" => "Pullovers & Vests",
	"30705" => "Trousers",
	"30704" => "Shirts",
	"30702" => "Swimwear",
	"30708" => "Dresses",
	"30701" => "Baby",
	"30703" => "Blouses",
	"30706" => "Jackets",
	"30707" => "Jeans",
	"30510" => "Pullovers",
	"30516" => "Sweaters",
	"30515" => "Beach and Swimwear",
	"30519" => "Bodywear",
	"30518" => "Vests",
	"30512" => "Shirts and Tops",
	"30513" => "Shorts",
	"30514" => "Sportswear",
	"30511" => "Skirts",
	"30517" => "Maternitywear",
	"30200" => "Watches",
	"30800" => "Shoes",
	"30804" => "Athletic Shoes",
	"30802" => "Men's Shoes",
	"30801" => "Women's Shoes",
	"30803" => "Children's Shoes",
	"30100" => "Accessories",
	"30710" => "Skirts",
	"30712" => "Bodywear",
	"30711" => "T-Shirts",
	"30500" => "Ladieswear",
	"30508" => "Multi-Piece Outfits",
	"30509" => "Ponchos",
	"30504" => "Trousers",
	"30501" => "Formal Attire",
	"30506" => "Jeans",
	"30507" => "Dresses",
	"30503" => "Leisure Suits",
	"30505" => "Jackets and Overcoats",
	"30502" => "Blouses",
	"30610" => "Shorts",
	"30613" => "Vests",
	"30612" => "Sweaters",
	"30611" => "Sportswear",
	"30614" => "Bodywear",
	"30400" => "Bags and Travel Gear",
	"30403" => "Rucksacks",
	"30401" => "Bags",
	"30404" => "Travel Gear",
	"30402" => "Suitcases",
	"30600" => "Menswear",
	"30607" => "Ponchos",
	"30605" => "Jackets & Overcoats",
	"30604" => "Trousers",
	"30608" => "Pullovers",
	"30609" => "Shirts & Tops",
	"30602" => "Swimwear",
	"30606" => "Jeans",
	"30601" => "Suits & Multi-Piece Outfits",
	"30603" => "Shirts",
	"30300" => "Jewellery",

	"40000" => "Books and Periodicals",
	"40200" => "Audiobooks & Radio Dramas",
	"40500" => "Sheet Music",
	"40300" => "Comics & Manga",
	"40400" => "Calendar",
	"40700" => "Periodicals & Magazines",
	"40600" => "Posters",
	"40100" => "Books",
	"40105" => "Esoteric",
	"40106" => "Travel Books & Maps",
	"40101" => "Fiction",
	"40103" => "Children's Books",
	"40104" => "How-to Manuals",
	"40102" => "Non-fiction",

	"50000" => "Music",
	"50500" => "DJ Equipment",
	"50110" => "Soul/R&B",
	"50112" => "World Music",
	"50111" => "Folk Music & Hits",
	"50400" => "Musical Instruments",
	"50200" => "Vinyl Records",
	"50300" => "Cassettes",
	"50100" => "CDs",
	"50108" => "Pop",
	"50102" => "Country",
	"50103" => "Dance & Electronic",
	"50107" => "Children's Music",
	"50104" => "Hip-Hop & Rap",
	"50106" => "Classical",
	"50101" => "Alternative",
	"50109" => "Rock",
	"50105" => "Jazz",

	"60000" => "DVDs & Videos",
	"60200" => "VHS Cassettes",
	"60100" => "DVDs",
	"60101" => "Action Films & Thrillers",
	"60108" => "Children & Family",
	"60103" => "Documentaries",
	"60106" => "Erotica",
	"60107" => "Horror",
	"60105" => "Oriental",
	"60109" => "Classics & Westerns",
	"60102" => "Bollywood",
	"60104" => "Drama & Romance",
	"60300" => "HD-DVDs & Blu-ray DVDs",
	"60110" => "Comedies",
	"60111" => "Music DVDs",
	"60112" => "Original Versions",
	"60114" => "TV Series",
	"60113" => "Science Fiction & Fantasy",
	"60400" => "Hire & Exchange",

	"70000" => "Computers & Software",
	"70400" => "Software",
	"70403" => "Console Games",
	"70402" => "Computer Games",
	"70401" => "PC & Mac Software",
	"70700" => "Enclosures & Power Adapters",
	"70706" => "Case Modding",
	"70705" => "Cables",
	"70702" => "HDD Enclosures",
	"70701" => "PC Cases",
	"70704" => "USV",
	"70703" => "Power Adapters",
	"70800" => "Input Devices",
	"70806" => "Card Readers",
	"70803" => "Graphics Tablets",
	"70802" => "Mice & Trackballs",
	"70805" => "KVM Switches",
	"70804" => "Joysticks & Steering Wheels",
	"70801" => "Keyboards",
	"70600" => "Components",
	"70604" => "Coolers and Fans",
	"70609" => "Video Editing Cards",
	"70608" => "TV & SAT Cards",
	"70605" => "Mainboards",
	"70601" => "Memory",
	"70602" => "Controllers",
	"70607" => "Sound Cards",
	"70606" => "Processors",
	"70603" => "Graphics Cards",
	"70900" => "Multimedia",
	"70902" => "Speakers & Surround-Sound Systems",
	"70901" => "Headsets & Microphones",
	"70903" => "Webcams",
	"70904" => "Remote Controls",
	"70500" => "Drives",
	"70505" => "Streamers",
	"70503" => "CD/DVD/Burners",
	"70506" => "Removable Disks",
	"70502" => "External Hard Drives",
	"70501" => "Internal Hard Drives",
	"70504" => "Diskette Drives",
	"70300" => "Game Consoles",
	"70303" => "Nintendo Wii",
	"70301" => "Playstation",
	"70302" => "Xbox",
	"70304" => "Other Consoles",
	"70305" => "Accessories",
	"70100" => "Computer Systems",
	"70101" => "Notebooks",
	"70102" => "Notebook Accessories",
	"70105" => "Servers",
	"70103" => "Fully Equipped PCs",
	"70104" => "Barebones",
	"70200" => "Peripherals",
	"70201" => "Printers",
	"70204" => "Monitors & Displays",
	"70205" => "Scanners",
	"70203" => "All-in-one printers/copiers/scanners",
	"70202" => "Printer Accessories",
	"71000" => "Consumables",
	"71004" => "Cleaning & Care",
	"71003" => "Inks & Toner",
	"71002" => "Papers & Foils",
	"71001" => "Media",
	"71200" => "Networks",
	"71202" => "Network Cards",
	"71207" => "Print Servers",
	"71201" => "Routers & Switches",
	"71205" => "Bluetooth",
	"71204" => "Wireless LAN",
	"71206" => "Firewalls",
	"71208" => "Network Accessories",
	"71203" => "Cables",
	"71100" => "Cables & Accessories",

	"80000" => "Electronics & Photography",
	"80900" => "Home Cinema & Projectors",
	"80902" => "AV Receivers & Surround Sound",
	"80901" => "Beamer & Accessories",
	"80903" => "Media Centre & AV Streaming",
	"80400" => "Hi-Fi & Audio",
	"80402" => "Receivers",
	"80407" => "Mini & Compact Systems",
	"80401" => "Tuners",
	"80404" => "CD Players",
	"80408" => "Speakers",
	"80406" => "Hi-Fi Systems",
	"80409" => "Headphones",
	"80405" => "Other Components (Cassette Decks, MD Players, Phonographs)",
	"80403" => "Amplifiers",
	"80600" => "Portable Entertainment",
	"80607" => "Other Players (CD, MD, DV)",
	"80604" => "Dictation Machines & Cassette Recorders",
	"80603" => "Televisions",
	"80601" => "MP3 Players",
	"80605" => "Radios",
	"80602" => "DVD & Multimedia Players",
	"80606" => "Accessories",
	"80100" => "Cameras & Photography",
	"80107" => "Tripods",
	"80102" => "Analogue Cameras",
	"80106" => "Photo & Camcorder Accessories",
	"80101" => "Digital Cameras",
	"80103" => "Camcorders",
	"80108" => "Power Supply",
	"80104" => "Photographic Accessories",
	"80105" => "Flash Devices",
	"80109" => "Bags & Cases",
	"80300" => "Memory Cards & USB Storage",
	"80302" => "SD/MMC",
	"80303" => "Memory Sticks",
	"80307" => "Portable HDD",
	"80301" => "CompactFlash and Microdrives",
	"80306" => "USB Sticks",
	"80304" => "XD Cards",
	"80305" => "Readers",
	"80200" => "Optical Devices",
	"80204" => "Magnifying Glasses",
	"80203" => "Telescopes",
	"80202" => "Microscopes",
	"80201" => "Binoculars",
	"80410" => "Racks",
	"80411" => "Clock Radios",
	"80412" => "DJ Equipment",
	"80700" => "Televisions",
	"80708" => "Special Applications (TV with built-in DVD, 12V)",
	"80701" => "Standard CRT TVs (4:3)",
	"80707" => "Satellite Reception",
	"80702" => "Widescreen CRT TVs (16:9)",
	"80709" => "Accessories",
	"80706" => "Receivers & Set-top Boxes",
	"80703" => "LCD TVs",
	"80704" => "Plasma TVs",
	"80705" => "Rear Projection TVs",
	"80800" => "DVDs & Videos",
	"80803" => "HD DVD & Blu-ray Players",
	"80801" => "DVD Players",
	"80802" => "DVD/HDD Recorders",
	"80804" => "Video Recorders",
	"80500" => "Navigation Systems",
	"80502" => "Mobile Devices",
	"80505" => "GPS Receivers",
	"80501" => "Integrated Devices",
	"80504" => "Software & Map Data",
	"80503" => "PDAs & Smartphones",
	"80506" => "Accessories",
	"80110" => "Services (Printing, Scanning, Developing)",

	"90000" => "Mobiles, Telephones & Fax Machines",
	"90300" => "VoIP",
	"90302" => "Providers & Contracts",
	"90301" => "Terminals",
	"90500" => "All-in-one printers/copiers/scanners",
	"90200" => "Landline",
	"90204" => "Answering Machines",
	"90203" => "Fax Machines",
	"90205" => "Providers & Contracts",
	"90201" => "Landline Phones",
	"90202" => "Cordless Phones",
	"90100" => "Mobile",
	"90109" => "Logos, Ring Tones & Games",
	"90104" => "Contracts and Cards without Mobiles",
	"90103" => "Mobiles with Prepaid Cards",
	"90102" => "Mobiles without a Contract",
	"90106" => "Smartphones",
	"90101" => "Mobiles with a Contract",
	"90107" => "Pagers",
	"90108" => "Wireless Devices",
	"90105" => "PDAs",
	"90400" => "Telephone Systems",

	"100000" => "Home & Garden",
	"100700" => "Tools & Machinery",
	"100704" => "Cleaning Systems",
	"100702" => "Workshop Equipment",
	"100701" => "Work Clothes & Protective Gear",
	"100705" => "Tools",
	"100703" => "Electric Tools",
	"100400" => "Installation & Home Engineering Systems",
	"100403" => "Building Automation",
	"100401" => "Heating & Air Conditioning",
	"100402" => "Electrical Installation",
	"100100" => "Bath & Kitchen",
	"100104" => "Accessories",
	"100105" => "Bathroom Ceramics",
	"100102" => "Installation Supplies",
	"100103" => "Bathroom Furniture",
	"100101" => "Fittings",
	"100500" => "Security Systems",
	"100300" => "Pet Supplies",
	"100301" => "Linings",
	"100303" => "Accessories",
	"100302" => "Care",
	"100800" => "Hardware",
	"100600" => "Walls & Flooring",
	"100604" => "Wallpapers",
	"100603" => "Tiles",
	"100602" => "Flooring",
	"100601" => "Colours",
	"100605" => "Accessories",
	"100900" => "Building Materials & Components",
	"100200" => "Garden",
	"100208" => "Swimming Pools",
	"100206" => "Sunshades",
	"100201" => "Plants",
	"100209" => "Grills & Barbecues",
	"100205" => "Gardening Tools",
	"100207" => "Illumination & Decoration",
	"100204" => "Garden Furniture & Buildings",
	"100202" => "Seeds, Fertilizers & Plant Protection",
	"100203" => "Irrigation & Garden Ponds",

	"110000" => "Household Goods and Furnishings",
	"110500" => "Kitchen Appliances",
	"110503" => "Toasters",
	"110504" => "Water Boilers",
	"110506" => "Juicers",
	"110502" => "Kitchen Appliances",
	"110505" => "Egg Boilers",
	"110501" => "Mixers & Hand Mixers",
	"110600" => "Bathroom Appliances",
	"110603" => "Epilators",
	"110602" => "Dental Care",
	"110604" => "Shavers & Hair Clippers",
	"110601" => "Hairstyling",
	"110300" => "Cooling & Freezing",
	"110304" => "Mini Fridges",
	"110301" => "Refrigerators",
	"110303" => "Refrigerator-Freezer Combos",
	"110302" => "Freezers",
	"110200" => "Cleaning & Washing",
	"110201" => "Washing Machines",
	"110202" => "Dryers",
	"110204" => "Hoovers",
	"110203" => "Washer Dryers",
	"110205" => "Dishwashers",
	"110206" => "Irons & Presses",
	"110100" => "Furnishings",
	"110104" => "Housewares",
	"110103" => "Decoration",
	"110105" => "Household Textiles",
	"110102" => "Lamps & Lighting",
	"110101" => "Furniture",
	"110800" => "Other Electric Appliances",
	"110400" => "Coffee & Espresso",
	"110402" => "Espresso Machines",
	"110403" => "Coffee Grinders",
	"110401" => "Coffee Machines",
	"110404" => "Accessories",
	"110700" => "Cooking & Grilling",
	"110704" => "Deep Fryers",
	"110702" => "Microwaves",
	"110705" => "Breadmakers",
	"110706" => "Gas & Charcoal Grills",
	"110701" => "Cook-top hobs, Ovens & Ranges",
	"110703" => "Electric Grills & Raclettes",

	"120000" => "Food & Beverages",
	"120100" => "Food & Beverages",
	"120200" => "Spirits",
	"120310" => "USA",
	"120300" => "Wine",
	"120307" => "Spain & Portugal",
	"120305" => "Austria",
	"120309" => "South Africa",
	"120304" => "Italy",
	"120302" => "Germany",
	"120303" => "France",
	"120308" => "South America",
	"120306" => "Eastern Europe",
	"120301" => "Australia",

	"130000" => "Children & Family",
	"130300" => "Car Safety Seats",
	"130100" => "Toys",
	"130700" => "Accessories (Baby monitors, baby-carriers, etc.)",
	"130500" => "Baby Furniture",
	"130400" => "Baby Care",
	"130200" => "Prams & Buggies",
	"130600" => "Maternitywear",

	"140000" => "Travel Sites & Airlines",
	"140700" => "Special Interest",
	"140705" => "Event Trips",
	"140702" => "City Tours",
	"140703" => "Wellness Holidays",
	"140701" => "Ski Trips",
	"140704" => "Short Trips",
	"140600" => "Holiday Flats & Homes",
	"140200" => "Flights",
	"140100" => "Package & All-inclusive Holidays",
	"140400" => "Car Hire",
	"140300" => "Hotels",
	"140500" => "Last-minute Holiday Deals",

	"150000" => "Games & Hobbies",
	"150600" => "Experiment & Learn",
	"150800" => "Crafts & Painting",
	"150500" => "Model Kits",
	"150400" => "Train Sets",
	"150200" => "Cars & Race Courses",
	"150300" => "Construction Kits",
	"150700" => "Toy Shop & Kitchen",
	"150100" => "Dolls & Stuffed Animals",
	"150900" => "Carnival & Mardi Gras",
	"151000" => "Outdoor Games",
	"151100" => "Baby Toys",
	"151200" => "Games & Puzzles",
	"151202" => "Children's Games",
	"151201" => "Adult & Family Games",

	"160000" => "Sport & Leisure",
	"160210" => "Equestrian Sports",
	"160218" => "Other Team Sports",
	"160213" => "Basketball",
	"160216" => "Cricket",
	"160214" => "Baseball",
	"160217" => "Rugby",
	"160215" => "American Football",
	"160211" => "Water Sports",
	"160219" => "Other Types of Sport",
	"160212" => "Winter Sports",
	"160200" => "Types of Sport",
	"160206" => "Golf",
	"160202" => "Action & Fun Sports",
	"160201" => "Fishing",
	"160209" => "Cycling",
	"160207" => "Diving",
	"160205" => "Football",
	"160204" => "Running",
	"160208" => "Tennis",
	"160203" => "Martial Arts",
	"160110" => "Alpine Sports",
	"160111" => "Knives & Tools",
	"160112" => "Other Accessories:",
	"160100" => "Camping & Outdoors",
	"160106" => "Childrenswear",
	"160102" => "Rucksacks",
	"160105" => "Menswear",
	"160109" => "Navigation & Clocks",
	"160104" => "Ladieswear",
	"160107" => "Shoes",
	"160101" => "Tents",
	"160108" => "Cooking",
	"160103" => "Sleeping Bags & Pads",
	"160300" => "Fan Items",
	"160400" => "Health & Wellness",

	"170000" => "Gifts",
	"170200" => "Gift Items",
	"170100" => "Flowers",
	"170300" => "Travel & Events",

	"180000" => "Tickets",
	"180410" => "Rugby",
	"180400" => "Sport Events",
	"180401" => "Basketball",
	"180407" => "Handball",
	"180403" => "Cricket",
	"180404" => "Ice Hockey",
	"180406" => "American Football",
	"180409" => "Tennis",
	"180402" => "Baseball",
	"180408" => "Motorsports",
	"180405" => "Football",
	"180300" => "Musicals",
	"180500" => "Other Events",
	"180200" => "Culture",
	"180204" => "Pageants",
	"180205" => "Readings",
	"180202" => "Operas & Operettas",
	"180201" => "Classical",
	"180203" => "Theatre",
	"180100" => "Concerts",
	"180102" => "Jazz & Blues",
	"180105" => "Hits & Folk Music",
	"180103" => "Hip-Hop, R&B & Soul",
	"180101" => "Rock & Pop",
	"180106" => "Festivals",
	"180104" => "Hard & Heavy",

	"190000" => "Property and Finance",
	"190400" => "Credit Cards & Giro Accounts",
	"190100" => "Residential Real Estate",
	"190102" => "Hire",
	"190101" => "Buy",
	"190300" => "Finance & Investments",
	"190500" => "Leasing",
	"190200" => "Insurance",

	"200000" => "School and Office",
	"200100" => "Office Supplies",
	"200600" => "School Supplies",
	"200400" => "Stationery",
	"200500" => "Graphics Products & Drafting Supplies",
	"200200" => "Office Equipment",
	"200300" => "Office Furniture",
	"210000" => "Erotica"
);

?>
