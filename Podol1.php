<?php
class Usluga {
    protected $imie;
    protected $nazwisko;
    protected $email;
    protected $iloscGodzin;
    protected $odleglosc;
    protected $potrzebnyPracownik;
    public function __construct($imie, $nazwisko, $email, $iloscGodzin, $odleglosc, $potrzebnyPracownik) {
        $this->imie = $imie;
        $this->nazwisko = $nazwisko;
        $this->email = $email;
        $this->iloscGodzin = $iloscGodzin;
        $this->odleglosc = $odleglosc;        $this->potrzebnyPracownik = $potrzebnyPracownik;
    }
    public function obliczCene() {
        $cenaKoparki = 100; // Przykładowa cena za godzinę koparki
        $cenaDojazdu = 2; // Przykładowa cena za 1 km dojazdu
        $cenaPracownika = 50; // Przykładowa cena za godzinę pracy pracownika dodatkowego
        $rabat = 0.1; // 10% rabatu za każdą kolejną godzinę

        $calkowitaCena = ($cenaKoparki * $this->iloscGodzin) + ($cenaDojazdu * $this->odleglosc);
        if ($this->potrzebnyPracownik) {
            $calkowitaCena += $cenaPracownika * $this->iloscGodzin;
        }

        // Rabat
        $calkowitaCena *= pow((1 - $rabat), $this->iloscGodzin);

        return $calkowitaCena;
    }

    public function wyswietlPowitanie() {
        return "Witaj, {$this->imie} {$this->nazwisko}! Na Twój adres email ({$this->email}) zostanie wysłana wycena usługi.";
    }
}

$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$email = $_POST['email'];
$iloscGodzin = $_POST['ilosc_godzin'];
$odleglosc = $_POST['odleglosc'];
$potrzebnyPracownik = isset($_POST['pracownik_dodatkowy']);
$promocja = $_POST['promocja'];

$usluga = new Usluga($imie, $nazwisko, $email, $iloscGodzin, $odleglosc, $potrzebnyPracownik);
$cena = $usluga->obliczCene();
$powitanie = $usluga->wyswietlPowitanie();

echo $powitanie . "<br>";
echo "Cena usługi po rabacie: " . $cena . " zł";
?>
