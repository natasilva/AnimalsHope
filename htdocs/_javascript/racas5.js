var racas_json = {
    "animais":[
        {
            "especie": "Gato",
            "racas": [
                "Sem raça definida(SRD)",
                "Abissínio",
                "Angorá",
                "Ashera",
                "Balinês",
                "Bengal",
                "Bobtail americano",
                "Bobtail japonês",
                "Bombay",
                "Burmês",
                "Chartreux",
                "Colorpoint de Pêlo Curto",
                "Cornish Rex",
                "Curl Americano",
                "Devon Rex",
                "Himalaio",
                "Jaguatirica",
                "Javanês",
                "Korat",
                "LaPerm",
                "Maine Coon",
                "Manx",
                "Mau Egípcio",
                "Mist Australiano",
                "Munchkin",
                "Norueguês da Floresta",
                "Pelo curto americano",
                "Pelo curto brasileiro",
                "Pelo curto europeu",
                "Pelo curto inglês",
                "Persa",
                "Pixie-bob",
                "Ragdoll",
                "Ocicat",
                "Russo Azul",
                "Sagrado da Birmânia",
                "Savannah",
                "Scottish Fold",
                "Selkirk Rex",
                "Siamês",
                "Siberiano",
                "Singapura",
                "Somali",
                "Sphynx",
                "Thai",
                "Tonquinês",
                "Toyger",
                "Usuri"
            ]
        },
        {
            "especie": "Cachorro",
            "racas":[
                "Sem raça definida(SRD)",
                "Afghan Hound",
                "Airedale Terrier",
                "Akita",
                "American Staffordshire Terrier",
                "Austrialian Cattle Dog (Boiadeiro Australiano)",
                "Basenji",
                "Basset Hound",
                "Beagle",
                "Bernese Mountain Dog",
                "Bichon Frisé",
                "Bloodhound",
                "Border Collie",
                "Borzoi",
                "Boston Terrier",
                "Boxer",
                "Buldogue Francês",
                "Buldogue Inglês (Bulldog)",
                "Bull Terrier",
                "Bullmastiff",
                "Cane Corso",
                "Cão de Crista Chinês",
                "Cavalier King Charles Spanies",
                "Chihuahua",
                "Chow Chow",
                "Cocker Spaniel Americano",
                "Cocker Spaniel Inglês",
                "Collie",
                "Dachshund (Teckel)",
                "Dálmata",
                "Doberman",
                "Dogo Argentino",
                "Dogue Alemão",
                "Dogue de Bordeaux",
                "Fila Brasileiro",
                "Fox Paulistinha",
                "Golden Retriever",
                "Greyhound",
                "Griffon de Bruxelas",
                "Husky Siberiano",
                "Jack Russel Terrier",
                "Kuvasz",
                "Labrador",
                "Leão da Rodésia - Rhodesian Ridgeback",
                "Lhasa Apso",
                "Lulu da Pomerânia (Spitz Alemão Anão)",
                "Malamute do Alasca",
                "Maltês",
                "Mastiff",
                "Old English Sheepdog",
                "Papillon",
                "Pastor Alemão (Capa Preta)",
                "Pastor Australiano",
                "Pastor Belga",
                "Pastor Branco Suíço (Pastor Canadense)",
                "Pastor de Shetland",
                "Pastor Maremano Abruzês",
                "Pequinês",
                "Pinscher",
                "Pit Bull (American Pit Bull Terrier)",
                "Pointer Inglês",
                "Poodle",
                "Pug",
                "Rottweiler",
                "Samoieda",
                "São Bernardo",
                "Schnauzer Miniatura",
                "Setter Irlandês",
                "Shar Pei",
                "Shiba Inu",
                "Shih Tzu",
                "Splitz Japonês",
                "Staffordshire Bull Terrier",
                "Terra-Nova",
                "Weimaraner",
                "Welsh Corgi Cardigan",
                "Welsh Corgi Pembroke",
                "West Highland White Terrier",
                "Whippet",
                "Yorkshire Terrier"
            ]
        }
    ]
}
function buscaRaca(e){
    var raca_animal = document.querySelector("#raça_animal");
    if(e != ''){
        document.querySelector("#raça_animal").innerHTML = '';
        var num_especies = racas_json.animais.length;
        var j_index = -1;
   
        // aqui eu pego o index da especie dentro do JSON
        for(var x=0;x<num_especies;x++){
          if(racas_json.animais[x].especie == e){
              j_index = x;
          }
        }
   
        if(j_index != -1){
          // aqui eu percorro todas as raças e crio os OPTIONS
          raca_animal.removeAttribute('disabled');
          racas_json.animais[j_index].racas.forEach(function(raca){
              var raca_opts = document.createElement('option');
              raca_opts.setAttribute('value',raca)
              
              if(raca_opts.value == document.getElementById('pre-raca').value){
                  raca_opts.setAttribute("selected","selected");
              }
              raca_opts.innerHTML = raca;
              raca_animal.appendChild(raca_opts);
          });
        }else{
          document.querySelector("#raça_animal").innerHTML = '';
        }
    }else{
        raca_animal.setAttribute('disabled', true);
        document.querySelector("#raça_animal").innerHTML = ''
    }
  }