
   
/*        $('p').each(function() {
         var $p = $(this);
         if($.trim($p.html())==='') {
            $p.remove();
         }
        });
        
        $('p').each(function() {
             var $p = $(this);
             if($.trim($p.html())==='&nbsp;') {
                $p.remove();
             }
        });
  
*/


$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

     //>=, not <=
    if (scroll >= 600) {
        //clearHeader, not clearheader - caps H
        $("section.header").addClass("darkHeader");
    }else{
        $("section.header").removeClass("darkHeader");
    }
}); //missing );



   wow = new WOW(
    {
    animateClass: 'animated',
    offset:       100,
    callback:     function(box) {
      console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
    }
    }
  );
  
 wow.init();
 
 
 $(".liq").click(function(){
     var id = $(this).attr("rel");
     $("#desc"+id).slideToggle();
     
 })
 
 
 
 
  $(".clist").click(function(){
      
      var id = $(this).attr("rel");
      
      if($("#fa"+id).hasClass("fa-plus")){
         $("#fa"+id).removeClass("fa-plus"); 
         $("#fa"+id).addClass("fa-minus"); 
      }else{
          $("#fa"+id).addClass("fa-plus"); 
         $("#fa"+id).removeClass("fa-minus"); 
      }
      
      
     
     $("#descs"+id).slideToggle();
     
 })
 
 
 $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});


 $(".tabdiv li a").click(function(){
     
    $(".tabdiv li a").removeClass("active");
    $(this).addClass("active");
    
    $(".tabcontent").hide();
     var id = $(this).attr("rel");
     $("#cont"+id).show();
     
 })
 
 
  $(".data-tabbing li a").click(function(){
     
    $(".data-tabbing li a").removeClass("active");
    $(this).addClass("active");
    
    $(".tab-content ").hide();
     var id = $(this).attr("rel");
     $("#tab-content"+id).show();
     
 })
 
 
 $("#mnu").click(function(){
     $(".navigationDiv").show();
     $(".mainwrapper").hide();
 })
 
 
  $("#mclose").click(function(){
     $(".navigationDiv").hide();
     $(".mainwrapper").show();
 })
 
 
 $('.slid').slick({
  infinite: true,
  slidesToShow: 1,
  slidesToScroll: 1,
     autoplay: true,
  autoplaySpeed: 2000,
  dots: false,
  arrows: false,
  });
 


 