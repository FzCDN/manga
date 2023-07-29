<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">

<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Bookmark - <?php echo SITE_TITLE; ?></title>

    <meta name="description" content="<?php echo SITE_TITLE; ?> - Tempatnya Baca Komik Online Terlengkap Bahasa Indonesia, Baca Manga Bahasa Indonesia, Baca Online One Piece Bahasa Indonesia, Baca Komik Solo Leveling Bahasa Indonesia, Baca Komik Apotheois Bahasa Indonesia">
    <meta name="keywords" content="<?php echo SITE_TITLE; ?>, <?php echo SITE_TITLE; ?> me, Komiku, Baca online One Piece, Baca Online Solo Leveling, Baca Online Apotheois, Baca Online Star Martial God Technique, Baca Komik lengkap, Baca Manga, Baca Manhua, Baca Manhwa">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='robots' content='no-index, no-follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
    
    <link rel='dns-prefetch' href='//cdn.jsdelivr.net' />
    <link rel='dns-prefetch' href='//cdnjs.cloudflare.com' />
    
    <link rel='stylesheet' href='/public/manga/style_v1.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/public/manga/darkmode.min.css' type='text/css' media='all' />
    <link rel="stylesheet" href="/public/manga/tooltip.css">
    <link rel='stylesheet' id='bootstrap-5-css' href='/public/manga/bootstrap.min.css' type='text/css' media='all' />
    
    <link rel='stylesheet' id='dashicons-css' href='/public/manga/dashicons.min.css' type='text/css' media='all' />
    <link rel='stylesheet' id='fontawesome-css' href='/public/manga/all.min.css' type='text/css' media='all' />
    <link rel='stylesheet' id='komik-redesign-css' href='/public/manga/komik.redesign.css' type='text/css' media='all' />
    
    <link rel="icon" href="<?php echo FAVICON_PATH; ?>" sizes="32x32" />
    <link rel="icon" href="<?php echo FAVICON_PATH; ?>" sizes="192x192" />
    <link rel="apple-touch-icon" href="<?php echo FAVICON_PATH; ?>" />
    <meta name="msapplication-TileImage" content="<?php echo LOGO; ?>" />

    <?php echo HEADER; ?>
    	
</head>

<body class="home page-template page-template-home page-template-home-php page-id-5 js darkmode" itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <div class="th">
        <div id="header-komik" class="centernav bound header">
            <div class="shme"><span class="dashicons dashicons-menu"></span></div>
            <header role="banner" itemscope itemtype="http://schema.org/WPHeader">
                <div itemscope="itemscope" itemtype="http://schema.org/Brand" class="site-branding logox">
                    <span class="logos">
                    <a title="<?php echo SITE_TITLE; ?> - Tempatnya Baca Komik Online Bahasa Indonesia"
                        itemprop="url" href="/"><img itemprop="logo"
                            src="<?php echo LOGO; ?>"
                            alt="<?php echo SITE_TITLE; ?> - Tempatnya Baca Komik Online Bahasa Indonesia"><span
                            class="hdl"><?php echo SITE_TITLE; ?> - Tempatnya Baca Komik Online Bahasa Indonesia</span></a>
                    </span>
                    <meta itemprop="name" content="<?php echo SITE_TITLE; ?> - Tempatnya Baca Komik Online Bahasa Indonesia" />
                </div>
            </header>
            <div class="searchx">
                <form action="/" id="form" method="get" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
                    <meta itemprop="target" content="/?s={query}" />
                    <input id="s" itemprop="query-input" class="search-live" type="text" placeholder="Search..." name="s" autocomplete="off" />
                    <button type="submit" id="submit" title="search" class="submit-search-input"><span
                        class="dashicons dashicons-search"></span></button>
                </form>
                <div id="search-ajax-result-wrapper" class="hidden">
                    <ul id="search-ajax-result"></ul>
                </div>
            </div>
            <div id="quickswitcher"> <span class="text">Light/Dark</span> <label aria-label="switch" class="switch"><input type="checkbox">
                <span class="slider round"></span></label></div>
        </div>
    </div>

    <nav id="main-menu" class="mm">
        <div class="centernav">
            <div class="bound">
                <span itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" role="navigation">
                <ul id="menu-header" class="menu">
                		<?php include 'part/menu.php'; ?>
                	</ul>
                </span>
            </div>
        </div>
    </nav>

    <div id="content">
        <div class="wrapper">
        	
        	
            <div class="postbody">

<style>
.gta-hpm h1{grid-area:h;}
.mark{grid-area:m;background:#1c1c1c;padding:15px;border-radius:.3rem;margin-bottom:1.66rem;}
.gta-hpm{display:grid;grid-template-areas:"h""m";gap:25px;}
.side-menu img{width:100%;}
.bsx img{width:40px;aspect-ratio:3/4;object-fit:cover;border-radius:2px;}
.box{display:grid;grid-template-columns:1fr auto;grid-template-areas:"l r";padding:5px;}
.side-menu ul{background:#1c1c1c;padding:15px;border-radius:.3rem;margin-bottom:1.66rem;list-style:none;}
.side-menu .menu li a{display:block;padding:8px 20px;border-radius:.3rem;margin:3px 0;color:#ababab;}
.side-menu .menu li a:hover{background:#292929;}
.box:nth-child(2n-1){background:#181818;}
.bsx img{width:40px;aspect-ratio:3/4;object-fit:cover;}
.bsx a{grid-area:j;}
.typez{grid-area:t;}
.bt{grid-area:s;}
.bsx img{grid-area:i;overflow:hidden;}
.btnRemove{grid-area:r;}
.bsx{display:grid;grid-template-areas:"i j j""i t s";grid-template-columns:auto auto 1fr;column-gap:10px;grid-area:l;align-items:center;}
@media screen and (max-width:340px){.bsx{grid-template-areas:"i j j" "i t t" "i s s";}}
.epx:empty{display:none;}
.epx{background-color:#d39e00;color:#212121;padding:0 5px;border-radius:3px;font-size:.8em;-webkit-transition:all .15s;-moz-transition:all .15s;transition:all .15s;color:white;}
.btnRemove svg{color:#921925;padding:5px;border-radius:2px;}
.btnRemove:hover svg{color:#dc3545;background:#2e2e2e;}
.more {padding: 3px 8px} 
.more {float: right}
.more {background-color: #454545} 
.more {border-radius: .25rem}

</style>

<div class='gta-hpm'>  
<div class="mark">
<div class='clearAll more cp'>Clear All</div>
<div class='notice'>Limit menyimpan daftar Seris tidak dibatasin. Daftar series disimpan di browser yang sedang kalian gunakan.Apabila anda membuka halaman ini dengan browser yang berbeda,maka daftar kalian yang sudah kalian simpan sebelumnya tidak akan tampil.</div>
<p class="text-muted"> - Click to icon to move anime to another folder.<br> - Click to Watched/Unwatched to change watch status. </p>
<div class='showBookmark'></div>
</div>
</div>




            <a href="#" class="scrollToTop"><span class="dashicons dashicons-arrow-up-alt2"></span></a>
        </div>
    </div>
    
    <div id="footer">
        <footer id="colophon" class="site-footer" itemscope="itemscope" itemtype="//schema.org/WPFooter" role="contentinfo">
            <div class="footercopyright">Semua komik di website ini hanya preview dari komik aslinya, mungkin terdapat banyak kesalahan bahasa, nama tokoh, dan alur cerita. Untuk versi aslinya, silahkan beli komiknya jika tersedia di kotamu.</div>
        </footer>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type='text/javascript' src='/public/manga/js/komik.redesign.js' id='komik-redesign-js'></script>
    <script type='text/javascript' src='/public/manga/js/bootstrap.min.js' id='bootstrap-5-js-js'></script>

    <script>
        jQuery((function(e) {
            e("#quickswitcher input").on("click", (function(t) {
                e(this).is(":checked") ? (e("body").addClass("darkmode"), e(".switch input").each((function(t, o) {
                    e(this).prop("checked", !0)
                })), localStorage.setItem("theme-mode", "darkmode")) : (e("body").removeClass("darkmode"), e(".switch input").each((function(t, o) {
                    e(this).prop("checked", !1)
                })), localStorage.setItem("theme-mode", "lightmode"))
            }))
        })), document.addEventListener("DOMContentLoaded", (() => {
            localStorage.getItem("theme-mode") || ($("body").addClass("darkmode"), $(".switch input").each((function(e, t) {
                $(this).prop("checked", !0)
            })), localStorage.setItem("theme-mode", "darkmode"))
        })), $(".score").each((function(e, t) {
            var o = $(t);
            o.barrating({
                theme: "fontawesome-stars",
                readonly: !0,
                initialRating: o.attr("data-current-rating")
            })
        }))
    </script>
    <script>
        $(document).ready((function() {
            $(".shme").click((function() {
                $(".mm").toggleClass("shwx")
            })), $(".expand").click((function() {
                $(".megavid").toggleClass("xp"), $(".pd-expand").toggleClass("sxp")
            })), $(".gnr").click((function() {
                $(".gnrx").toggleClass("shwgx")
            })), $(".filter").click((function() {
                $(".advancedsearch").toggleClass("advs")
            }))
        }))
    </script>
    <script>
        $(document).ready((function() {
            $(window).scroll((function() {
                $(this).scrollTop() > 100 ? $(".scrollToTop").fadeIn() : $(".scrollToTop").fadeOut()
            })), $(".scrollToTop").click((function() {
                return $("html, body").animate({
                    scrollTop: 0
                }, 800), !1
            }))
        }))
    </script>

    <script>
var bookmark = (function() {
  let list = [];

  // Event Saving to Local Storage
  function setBookmark() {
    localStorage.setItem('bookmarkedKomik', JSON.stringify(list));
  }

  function loadBookmark() {
    list = JSON.parse(localStorage.getItem('bookmarkedKomik')) || [];
  }

  if (localStorage.getItem('bookmarkedKomik') != null) {
    loadBookmark();
  }

  const obj = {};
  // Clear Bookmark
  obj.clearALL = function() {
    list = [];
    setBookmark();
  };

  // Remove Bookmark
  obj.removeThisItem = function(id) {
    for (let i = 0; i < list.length; i++) {
      if (list[i].id === id) {
        list.splice(i, 1);
        break;
      }
    }
    setBookmark();
  };

  return obj;
})();

function displayIt(){
var getData = JSON.parse(localStorage.getItem('bookmarkedKomik'));
  var structure = '';
  for(var i in getData){
   structure += '<article class="box" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">'
			 +	'<div id="'+getData[i].id+'" class="bsx">'
			 +	'<a href="'+getData[i].link+'" itemprop="url" title="'+getData[i].title+'">'+getData[i].title+'</a>'
			 +	'<div class="typez"><span class="epx '+getData[i].type+'">'+getData[i].type+'</span></div>'
			 +	'<div class="bt"><span class="epx '+getData[i].rating+'">'+getData[i].rating+'</span></div>'
			 +	'<img src="'+getData[i].image+'" loading="lazy" itemprop="image" title="'+getData[i].title+'" alt="'+getData[i].title+'"></div>'
			 +	'<div class="btnRemove" data-id="'+getData[i].id+'"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="2em" height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024"><path fill="currentColor" d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448s448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372s372 166.6 372 372s-166.6 372-372 372z"/><path fill="currentColor" fill-opacity=".15" d="M512 140c-205.4 0-372 166.6-372 372s166.6 372 372 372s372-166.6 372-372s-166.6-372-372-372zm171.8 527.1c1.2 1.5 1.9 3.3 1.9 5.2c0 4.5-3.6 8-8 8l-66-.3l-99.3-118.4l-99.3 118.5l-66.1.3c-4.4 0-8-3.6-8-8c0-1.9.7-3.7 1.9-5.2L471 512.3l-130.1-155a8.32 8.32 0 0 1-1.9-5.2c0-4.5 3.6-8 8-8l66.1.3l99.3 118.4l99.4-118.5l66-.3c4.4 0 8 3.6 8 8c0 1.9-.6 3.8-1.8 5.2l-130.1 155l129.9 154.9z"/><path fill="currentColor" d="M685.8 352c0-4.4-3.6-8-8-8l-66 .3l-99.4 118.5l-99.3-118.4l-66.1-.3c-4.4 0-8 3.5-8 8c0 1.9.7 3.7 1.9 5.2l130.1 155l-130.1 154.9a8.32 8.32 0 0 0-1.9 5.2c0 4.4 3.6 8 8 8l66.1-.3l99.3-118.5L611.7 680l66 .3c4.4 0 8-3.5 8-8c0-1.9-.7-3.7-1.9-5.2L553.9 512.2l130.1-155c1.2-1.4 1.8-3.3 1.8-5.2z"/></svg></div></article>';
  }
   if(getData == null || getData == ''){
  $('.showBookmark').html('Maaf tidak ada item bookmark');
  }else{
  $('.showBookmark').html(structure);
  }
}
$('.clearAll').click(function(){
  bookmark.clearALL();
  displayIt();
});

$('.btnRemove').click(function() {
  bookmark.removeThisItem($(this).data('id'));
});


displayIt();

</script>
    <?php echo FOOTER; ?>
    	
</body>
</html>
