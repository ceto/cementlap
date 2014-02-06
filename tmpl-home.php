<?php
/*
Template Name: Home Template
*/
?>


<section class="refstarter-list">
  <header class="refstarthead">
    <h1>Mit csinálunk?</h1>
    <h2>Kiemelkedő <span>minőségben</span> és színvonalon tervezünk - gyártunk teljes <span>üzletberendezéseket</span> és közületi bútorokat.</h2>
  </header>
  <?php for ($i=1; $i < 6; $i++ ) { ?>
    <a href="#" class="refstarter">
        <header>
          <div>
            <div class="descr">Nisi erat porttitor elyszíni felmérés és árajánlatkészítés mely tartalmazza a bútorok,
          a bártechnológia, a konyhatechnológia, ligula, eget lacinia odio sem nec elit.</div>
          </div>
        </header>
        <h3>Étterem</h3> 
        <div class="illustration" style="background-image:url('http://lorempixel.com/6<?php echo $i*10; ?>/6<?php echo $i*10; ?>/nightlife')"></div>
    </a>
  <?php } ?></section>

<section class="about-us">
  <header class="tevhead">
    <h1>Hogyan dolgozunk</h1>
  </header>
  <ol class="tevlist">
    <li class="tevekenyseg">
      <figure class="tevifig">
        <img src="http://placehold.it/160x160/C4C6AB/231F06" alt="">
      </figure>
      <div class="tevdesc">
        <h3>Helyszini felmérés és ajánlat készítés</h3>
        <p>
          Az ország egész területén díjtalan helyszíni felmérés és árajánlatkészítés mely tartalmazza a bútorok,
          a bártechnológia, a konyhatechnológia, a mobíilák és a dizájnelemek árait a szállítással és a beszereléssel.
        </p>
      </div>

    </li>
    <li class="tevekenyseg">
      <figure class="tevifig">
        <img src="http://placehold.it/160x160/C4C6AB/231F06" alt="">
      </figure>
      <div class="tevdesc">
        <h3>Számítógépes tervezés - látványtervezés</h3>
        <p>
          Nagy tapasztalattal rendelkező, fiatal és lendületes tervezőgárdával, - a megrendelő
          egyedi igényeivel harmonizáló -, izgalmas belső tér tervezése az üres, kopár falak közé. 
        </p>
      </div>
    </li>
    <li class="tevekenyseg">
      <figure class="tevifig">
        <img src="http://placehold.it/160x160/C4C6AB/231F06/" alt="">
      </figure>
      <div class="tevdesc">
        <h3>Gyártás és kivitelezés saját üzemben</h3>
        <p>
          Saját, jól felszerelt asztalosműhelyünkben jól képzett asztalosokból és lakatosokból álló csapat
          gondoskodik a megfelelő minőségről, a gördülékeny gyártásról, és a gyártási időpontok betarásáról.
        </p>
      </div>
    </li>
    <li class="tevekenyseg">
      <figure class="tevifig">
        <img src="http://placehold.it/160x160/C4C6AB/231F06" alt="">
      </figure>
      <div class="tevdesc">
        <h3>Szállítás, beszerelés és kulcsrakész átadás</h3>
        <p>
          A szállítás saját teherautóval történik, beszerelés alkalmával akár 12 fős csapat felvonultatásával.
          A főbb bútorelemeken kívűl helyükre kerülnek a mobíliák és a dizájnelemek, majd egy piperetakarítást
          követően indulhat az árufeltöltés és megnyílhat az Ön üzlete.
        </p>
      </div>

    </li>
  </ol>
</section>

