$(document).ready(function () {
    $.ajax({
        type: "POST",
        url: "index.php",
        data: { limit: 10 },
        success: function (response) {
            let data = JSON.parse(response);

            let news_index = 0;
            let events_index = 0;
            let news_array = data.news || [];
            let events_array = data.events || [];

            function update_news(index) {
                if (news_array[index]) {
                    $(".news_title").text(news_array[index].title);
                    $(".news_des").text(news_array[index].description);
                }
            }

            function update_event(index) {
                if (events_array[index]) {
                    $(".event_title").text(events_array[index].title);
                    $(".event_text").text(events_array[index].description);
                }
            }

            // Initial render
            update_news(news_index);
            update_event(events_index);
            console.log("Initial news:", news_array);
            console.log("Initial events:", events_array);

            $(".icon1.first_next_button").on("click", function () {
                console.log("news_index in go next button is: " + news_index)
                if (news_index < news_array.length - 1) {
                    news_index++;
                    update_news(news_index);
                    console.log("News index after next:", news_index);
                } else {
                    $(".news_title").text("That's All The News");
                    $(".news_des").text("Go To Events And News To See More");
                }
            });

            // NEWS PREV
            $(".icon1.first_pre_button").on("click", function () {
                console.log("news_index in go back is: " + news_index)
                console.log("Clicked NEWS back", news_index);
                if (news_index > 0) {
                    update_news(news_index);
                    console.log("we are in if news_index > 0")
                    news_index--;
                }else{
                    update_news(news_index);
                }
            });

            // EVENTS NEXT
            $(".icon2.first_next_button").on("click", function () {
                console.log("event_index in go next is: " + events_index)
                if (events_index < events_array.length - 1) {
                    events_index++;
                    update_event(events_index);
                    console.log("Event index after next:", events_index);
                } else {
                    $(".event_title").text("That's All The Events");
                    $(".event_text").text("Go To Events And News To See More");
                }
            });

            // EVENTS PREV
            $(".icon2.first_pre_button").on("click", function () {
                console.log("event_index in go back is: " + events_index)
                if (events_index > 0) {
                update_event(events_index);
                    events_index--;
                    console.log("Event index after prev:", events_index);
                }else{
                    update_event(events_index);
                }
            });
        },
        error: function (xhr, status, error) {
            console.log("Error:", error);
        }
    });
});
