$(document).ready(function(){
    console.log($(".news_des"));
    $.ajax({
        type: "POST",
        url: "index.php",
        data: {limit:10},
        success: function (response) {
            let data =JSON.parse(response);
            let news_index = 0;
            let events_index = 0;
            let news_array = [];
            let events_array = [];
            function go_next_news_or_back(array,index){
                console.log(array)
                console.log(index)
                if(index < array.length && index > 0){
                    console.log("index :"+index)
                $(".news_title").text(array[index].title);
                $(".news_des").text(array[index].description);   
                }
            }
            function go_next_event_or_back(array,index){
                console.log(array)
                console.log(index)
                if(index < array.length || index > 0){
                    $(".event_title").text(array[index].title);
                    $(".event_text").text(array[index].description);
                }
            }
            data.news.forEach(element => {
                news_array.push(element)
            });
            data.events.forEach(element => {
                events_array.push(element)
            });
            $(".news_title").text(news_array[news_index].title);
            $(".news_des").text(news_array[news_index].description);
            $(".event_title").text(events_array[events_index].title);
            $(".event_text").text(events_array[events_index].description);
            $("button").on("click", function () {
    let what_to_do = $(this).attr("class");

    switch (what_to_do) {
        case "icon1 first_next_button":
            if (news_index < news_array.length - 1) {
                news_index++;
                go_next_news_or_back(news_array, news_index);
            }else{
                $(".news_title").text("Thats All The News");
                $(".news_des").text("Go To Events And News To See More");
            }
            break;
        case "icon1 first_pre_button":
            if (news_index > 0) {
                news_index--;
                go_next_news_or_back(news_array, news_index);
            }
            break;
        case "icon2 first_next_button":
            console.log("clicked second nex")
            if (events_index < events_array.length - 1) {
                events_index++;
                go_next_event_or_back(events_array, events_index);
            }else{
                $(".event_title").text("Thats All The Events");
                $(".event_text").text("Go To Events And News To See More");
            }
            break;
        case "icon2 first_pre_button":
            if (events_index > 0) {
                events_index--;
                go_next_event_or_back(events_array, events_index);
            }
            break;
    }
});

            console.log(news_array);
            console.log(events_array);
            
        },
        error: function(one,two,three){
            console.log(three)
        }
    });
   
    

})