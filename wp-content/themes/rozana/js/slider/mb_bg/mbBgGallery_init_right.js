// JavaScript Document

$(function ($) {

    //BG SLIDESHOW WITH ZOOM EFFECT
    $.mbBgndGallery.buildGallery({
                containment:"body",
                timer:3000,
                effTimer:1000,
                controls:"#controls",
                grayScale:false,
                shuffle:true,
                preserveWidth:false,
                preserveTop: true,
                effect:"slideRight",
	//effect:{enter:{transform:"scale("+(1+ Math.random()*2)+")",opacity:0},exit:{transform:"scale("+(Math.random()*2)+")",opacity:0}},

                // If your server allow directory listing you can use:
                // (however this doesn't work locally on your computer)

                //folderPath:"testImage/",

                // else:

                 images:[
                 "img/slideshow/7.jpg",
                 "img/slideshow/8.jpg",
				 "img/slideshow/9.jpg",
                 ],

                onStart:function(){},
                onPause:function(){},
                onPlay:function(opt){},
                onChange:function(opt,idx){},
                onNext:function(opt){},
                onPrev:function(opt){}
            });


   
});