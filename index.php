<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mitr">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">


    <title>Kajaki u Daniela</title>
    <style>
     
    </style>
</head>
<body>
    <?php
    require("menu.php")
    ?>

    <h1>Kajaki Przy Zamku w Liwie</h1>
    <p>Oferujemy Państwu wypożyczenie kajaków na spływ przepiękną Doliną Liwca. Jest to fantastyczny sposób na urozmaicenie wolnego czasu. Dostarczymy Państwu niezapomnianych wrażeń oraz atrakcji. Liwcem można płynąć nawet około 120 kilometrów. Zazwyczaj wybierany jest środkowy odcinek Liwca z Wyszkowa (gmina Liw) do Liwa, podczas którego można podziwiać przepiękne krajobrazy. Na trasie występują również plaże, na których można odpocząć. Często rzekę otaczają wysokie skarpy, na których można spotkać dzikie ptactwo. Na koniec spływu można zwiedzić ruiny gotyckiego zamku książęcego wzniesionego w XV w. jako strażnica graniczna w miejscowości Liw. Zaraz obok zamku znajduje się Karczma w której można zjeść, wypić oraz przenocować co jest również atutem mety spływu.</p>
    <h1>Wypożyczalnia kajaków Liw</h1>
    <p>Odwiedzając tę malowniczą okolicę warto wygospodarować czas na spływ kajakowy Liw, ponieważ z tej perspektywy Dolina prezentuje się bardzo pięknie i okazale. Spływ kajakowy Liwiec, będzie znakomitą atrakcją również dla osób, które podróżują z dziećmi. Dla wszystkich tych, którzy lubią aktywnie spędzać czas na świeżym powietrzu, będzie to idealny pomysł na oderwanie się od codziennych obowiązków i odpoczynek wśród pięknych widoków. Kajaki Liwiec zyskują coraz większa popularność, a część z gości, która Nas odwiedza chętnie wraca, aby ponownie skorzystać z atrakcji i jeszcze raz móc podziwiać otaczającą przyrodę. Dolina Liwca, jest jedną z najpiękniejszych a zarazem najchętniej odwiedzanych terenów na Mazowszu. Ciągle rosnące zainteresowanie na zwiedzenie terenów Doliny powoduje, że wychodzimy na przeciw oczekiwaniom Klientów i chcemy aby ich pobyt u Nas był jak najbardziej przyjemny i beztroski. Mając na uwadze powyższe, zadbaliśmy o to aby nie musieli Państwo martwić się o sprzęt niezbędny do tego, aby cieszyć się spływem kajakowym. Chcąc zadbać o Państwa komfort powstała nasza wypożyczalnia kajaków Liw, która oferuje sprawdzony i bezpieczny sprzęt. Planując podróż w nasze strony jednym z obowiązkowych punktów na mapie powinna być wypożyczalnia kajaków Liwiec, aby móc w pełni wykorzystać potencjał jaki oferuje Dolina Liwca. Jeśli nie macie pomysłu na szybki wypad, który naładuje Wasze baterie na długi czas, zachęcamy do odwiedzenia Doliny Liwca, która zachwyci Was swoim pięknem i sprawi, że chętnie będziecie tu wracać.</p>
    <h1>Galeria</h1> 
    <div>
        <ul>
            <li><img class="obrazek" src="images/1.jpg"></li>
            <li><img class="obrazek" src="images/2.jpg"></li>
            <li><img class="obrazek" src="images/3.jpg"></li>
        </ul>
    </div>
    <div>
        <ul>
            <li><img class="obraz" src="images/4.jpg"></li>
            <li><img class="obraz" src="images/5.jpg"></li>
            <li><img class="obraz" src="images/6.jpg"></li>
        </ul>
    </div>
    <div class="opinia">
    <h1>Opinie</h1>
    <div class="opinia-container">
        <div class="opinia-content">
            <h3>Jan</h3>
            <p>Polecam serdecznie</p>
        </div>
        <div class="paski-opinii">
            <div class="pasek" onclick="pokazOpinie(0)"></div>
            <div class="pasek" onclick="pokazOpinie(1)"></div>
            <div class="pasek" onclick="pokazOpinie(2)"></div>
        </div>
    </div>
</div>



    <script>
      const opinie = [
    {
        autor: 'Jan',
        tresc: 'Polecam serdecznie'
    },
    {
        autor: 'Anna',
        tresc: 'Niesamowite widoki'
    },
    {
        autor: 'Damian',
        tresc: 'Polecam bardzo miło można spędzić czas'
    }
];

const opiniaElement = document.querySelector('.opinia-container');
const paskiOpinii = document.querySelectorAll('.pasek');
let currentOpiniaIndex = 0;

function pokazOpinie(indeks) {
    if (indeks >= 0 && indeks < opinie.length) {
        const opinia = opinie[indeks];
        const autorElement = opiniaElement.querySelector('h3');
        const trescElement = opiniaElement.querySelector('p');

        autorElement.textContent = opinia.autor;
        trescElement.textContent = opinia.tresc;

        paskiOpinii.forEach((pasek, i) => {
            if (i === indeks) {
                pasek.classList.add('aktywny');
            } else {
                pasek.classList.remove('aktywny');
            }
        });

        currentOpiniaIndex = indeks;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const opiniaElement = document.querySelector('.opinia-container');
    const paskiOpinii = document.querySelectorAll('.pasek');
    let currentOpiniaIndex = 0;

    function pokazOpinie(indeks) {
        if (indeks >= 0 && indeks < opinie.length) {
            const opinia = opinie[indeks];
            const autorElement = opiniaElement.querySelector('h3');
            const trescElement = opiniaElement.querySelector('p');

            autorElement.textContent = opinia.autor;
            trescElement.textContent = opinia.tresc;

            paskiOpinii.forEach((pasek, i) => {
                if (i === indeks) {
                    pasek.classList.add('aktywny');
                } else {
                    pasek.classList.remove('aktywny');
                }
            });

            currentOpiniaIndex = indeks;
        }
    }

    function automatycznaZmianaOpinii() {
        currentOpiniaIndex = (currentOpiniaIndex + 1) % opinie.length;
        opiniaElement.classList.remove('active');
        setTimeout(() => {
            pokazOpinie(currentOpiniaIndex);
            opiniaElement.classList.add('active'); 
        }, 500); 
    }


    setInterval(automatycznaZmianaOpinii, 7000);

    pokazOpinie(0);
    opiniaElement.classList.add('active');
});
    </script>
</body>
<?php
require("footer.php")
?>
</html>