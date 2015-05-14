tp_days=0;
tp_hours = 0
tp_minutes = 0
tp_seconds = 0

function calc_data(tp_date,tp_time){
    tempdate = tp_date.split("/");
    temptime = tp_time.split(":");
    var seconds=1000;
    var minutes=seconds*60;
    var hours=minutes*60;
    var days=hours*24;
    var years=days*365;
    
    var db_time = new Date(tempdate[0], tempdate[1]-1, tempdate[2], temptime[0], temptime[1], 00);
    var now_time = new Date();
    db_time = db_time.getTime();
    now_time = now_time.getTime();
	
    var tp_result = db_time-now_time;
	//console.log(db_time);
    if(tp_result<0)
        tp_years=tp_days=tp_hours=tp_minutes=tp_seconds=0;
    else{
        tp_years = Math.floor(tp_result/years);
		
        tp_days = Math.floor(tp_result/days)-(tp_years*365);
        tp_hours = Math.floor(tp_result/hours)-(tp_days*24)-(tp_years*365*24);
        tp_minutes = Math.floor(tp_result/minutes)-(tp_hours*60)-(tp_days*24*60)-(tp_years*365*24*60);
        tp_seconds = Math.floor(tp_result/seconds)-(tp_minutes*60)-(tp_hours*60*60)-(tp_days*60*24*60)-(tp_years*365*24*60*60);
        singlebox=false;
        if(tp_years>99){
            tp_years=99;
        }
        if(tp_days>99){
            
            singlebox=true;
        }
        if(tp_years<0)tp_years=0;
        if(tp_days<0)tp_days=00;
        if(tp_hours<0)tp_hours=00;
        if(tp_minutes>60)tp_minutes=60;
        if(tp_minutes<0)tp_minutes=00;
        if(tp_seconds<0)tp_seconds=00;
    }
}
function tp_set(tp_parentClass,tp_date, tp_time){
    calc_data(tp_date, tp_time);
	jQuery(tp_parentClass).find('.year').html(tp_years);
	jQuery(tp_parentClass).find('.days').html(tp_days);
	jQuery(tp_parentClass).find('.hours').html(tp_hours);
	jQuery(tp_parentClass).find('.mins').html(tp_minutes);
	jQuery(tp_parentClass).find('.secs').html(tp_seconds);  
    
    var tp_timer = setInterval('tp_set(\''+tp_parentClass+'\',\''+tp_date+'\',\''+tp_time+'\');', 1000 );
    clearTimeout(tp_timer);
}
jQuery(document).ready(function($) {
    function start_by_parent(tp_parentClass){
        var tp_timer ='';
        tp_date=$(tp_parentClass+' input.tp-widget-date').val();
		tp_time=$(tp_parentClass+' input.tp-widget-time').val();
    
    tp_timer = setInterval("tp_set('"+tp_parentClass+"','"+tp_date+"','"+tp_time+"');", 1000);
        
    }
    start_by_parent('.timer-main');
    start_by_parent('.timer-content');
    

});