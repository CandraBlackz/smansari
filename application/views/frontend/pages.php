<section class="main-content course-single">
    <div class="container">
        <div class="content-course">
            <div class="row">
                <div class="col-md-9">
                    <article class="post-course">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <span class="text-center"><h3 class="panel-title" >Kontak </h3></span>
                                    </div>
                                    <div class="panel-body">
                                        <div class="item-thumbnail">
                                            <img src="<?php echo base_url();?>assets/web/images/smansari.png">
                                        </div>

                                        <div class="course-description">
                                            <p class="course-text"><?=$title ?></p>
                                            
                                            <div class="course-meta">
                                                <p>Jl. Yogya - Solo, Pakis, Wonosari, Klaten</p>
                                                <p><?=$teks_kontak ?></p>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="col-md-9">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <span class="text-center"><h3 class="panel-title" >Profil Hubungan Alumni </h3></span>
                                    </div>
                                    <div class="panel-body">
                                      <div class="content-content">
                                        <h3>Siapakah Alumni ?</h3>
                                        <div class="content-dropcap">
                                            <p align="justify"><?=$visi ?></p>
                                        </div>
                                    </div><!--/content-content-->
                                    <hr>
                                    <div class="content-content">
                                        <h3>Apa yang kami lakukan ?</h3>
                                        <div class="content-dropcap">
                                            <p align="justify"><?=$misi ?></p>
                                        </div>
                                    </div><!--/content-content-->
                                </div>
                            </div>
                        </div>

                    </div>        
                </article>
            </div>
            <?php include('sidebar_news.php');?>
        </div>
    </div>
</div>
</section>