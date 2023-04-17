
<?php 

$this->view('partials.frontend.header',[
    "menus"=>$menus,
    "categories"=>$categories
]) ?>
<section id="Slider">
        <div class="aspect-ratio-169">
            <a href="">
                <img src="https://pubcdn.ivymoda.com/files/news/2021/12/17/49150f4b8b5e77f3561ba7f0c9dff031.jpg" alt="">
            </a>
            <a href="">
                <img src="https://pubcdn.ivymoda.com/files/news/2021/12/30/14abe600de692150cf81102e93d41d0c.jpg" alt="">
            </a>
            <a href="">
                <img src="https://pubcdn.ivymoda.com/files/news/2021/12/11/00c3757ac0c9f73be935f07973be89c4.jpg" alt="">
            </a>
            <a href="">
                <img src="https://pubcdn.ivymoda.com/files/news/2021/12/23/f9d75156bcbf9c717c3b2b4578d3d74d.jpg" alt="">
            </a>
        </div>
        <div class="dot-container">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </section> 

<?php $this->view('partials.frontend.footer',[]) ?> 