/*
********************************************************************************
******************************* SYNTAX V2 ***************************************
********************************************************************************
*/
// $ for jQuery
// ("p") for all elemnt for this one all p elemnt in the php
// hide() function that will be apply on element
// $("p").hide(); //hide the p
//$("p").css("","") // for css
//this here we will apply the code after the the documn load like after the documnt is ready apply this code 
// $(document).ready(function(){

// });
// short form
// $(function(){
//     // $("p").hide()
//     $("p").css("font-size","30px")
// })



/*
********************************************************************************
******************************* EVENT V3 ***************************************
********************************************************************************
*/
// $("element you want to apply it on").event() //the event i just put it there there will be events like .click .dblclick .Mouseenter mouseleave hover ect
// let a = false
//i used the key word this in the one and the effect effected the button its self
//and btw hover() can tick two functions
// $(document).ready(function(){
//     $(".jq").hover(function(){
//         $("p").css("color","red")
//     },
//     function(){  
//         $("p").css("color","blue")
//     }
// )
// }) 


/*
********************************************************************************
******************************* HIDE SHOW TOGGEL V4 ***************************************
********************************************************************************
*/
//hide(speed(ms), calback funciton) : THIS ONE WORKS LIKE ARGUMENTS WORKS AS STYLING THE SPEED IS THE SPEED OF DISAPEERING WITH A REALLY GOOD TRANSTION or you can use the key word slow and fast ,if we set a speed that speed will includes the function exuting time as will you can call a function
//toggle(speed,call back function) : if the elemnt is showen its makes it hidden and oppeset is true as will and as hide you can use call back funciton and time

// let p = document.querySelector("p")
// $(document).ready(function(){
//     $(".jq").click(function(){
//         // $("p").toggle("yahya");
//         $("p").toggle(1000,function(){
//             console.log("its was gone")
//         });
//         // $("p").css.color = "red";
//         console.log(p)
//      })
    
// })

/*
********************************************************************************************************************************
*******************************  Effects - Fade In / Fade Out / Fade Toggle / Fade To V5 ***************************************
********************************************************************************************************************************
*/
//fadeIn(speed,function that will be apply after the fadein effect is dont) : if the element is displayed none in the screen its will get displayed block but with a fade in animation and its works base on opacity
//fadeOut(speed,function that will be apply after the fadein effect is dont) : if the element is displayed in the screen its will get displayed none but with a fade out animation and its works base on opacity
//fadeToggle(speed, function that will be apply after the fade effect is dont) : if the element is displayed its will get displayed none and if the element is not dislayed its will get displayed block base on its status but with a fade animtion
//fadeTo(speed(or fast or slow),opacity,call back function) :speed of transion , opacity level,  you gave a value that is the opacity that the element will tick

// $(document).ready(function(){
//   $(".click").click(function(){
//     $("div").fadeTo("slow",0.1);
//   })
// })

/*
********************************************************************************************************************************
*******************************  Effects - SlideDown / SlideUp / SlideToggle V6 ***************************************
********************************************************************************************************************************
*/
  // $("div").slideToggle(speed(time tickes to complete the effect),function); // SlideToggle between dislay block and none
        // $("div").slideDown(speed(time tickes to complete the effect),function)// if the elemnt is not displayed the slideDown will make it silde Down with a good animation then set it to display block
        //  $("div").slideUp(speed(time tickes to complete the effect),function) // if the elemnt is displayed the slideUp will make it sildeUp with a good animation then set it to display none
// $(document).ready(function(){
//     $(".click").click(function(){
//         // $("div").slideToggle(); // 
//         // $("div").slideDown()// 
//         //  $("div").slideUp() // 

//     })
// })



/*
********************************************************************************************************************************
*******************************  !!!!!  Effects - Animate V7 ***************************************
********************************************************************************************************************************
*/
//animate({parametars},speed,callback funciton)// this is used for animation {this one is used to set the css proprtys that the elemnt will ticks},speed that the animate will tick ,function that may have somthing in it like make another div big or somthing and you can use + - and += -= with this animate
/**
 * animate({
 * width:"+=50px", // here the width of the element i used this on will be his width + 50px BTW you can use the prevuse function like toggle hide show
 *
 * })
 * and you can stack a parametars after one and that how you can create animations after animations
 */


// $(document).ready(function(){
//         //this one will work after its end
//         $("div").animate({
//             width:"toggle",
//             height:"toggle",

//         },2000);
//         //this one will work after the last one work
//         $("div").animate({
//             width:"toggle",
//             height:"toggle",
//         },2000)
//         $("div").animate({
//             width:"toggle",
//             height:"toggle",

//         },2000);
//         //this one will work after the last one work
//         $("div").animate({
//             width:"toggle",
//             height:"toggle",
//         },2000)
        


// })

/*
********************************************************************************************************************************
*******************************   Effects - Stop V7 ***************************************
********************************************************************************************************************************
*/
//if you gave a element that has animate on it its will stop the animate
//.stop(clearQueu,goToend)
//$("button").stop(false) will skip the animate and go to the next animation 
//$("button").stop(true) will stop the animation where it is at the moment you clicked the button and will not go to the next one
//$("button").stop(true,true) will stop the animation where it is at the moment you clicked the button and stay at that form
//$("button").stop(false,true) will skip the animation where it is at the moment you clicked the button and tick you to next form




// $(document).ready(function(){
//         //this one will work after its end
//         $("button").click(function(){
//             $(".animat").stop(false,true); // this will stop the animate and the div will be in the state it was in the last time
//         })
//         $(".animat").animate({
//             width:"500px",
//             height:"300px",

//         },2000);
//         //this one will work after the last one work
//         $(".animat").animate({
//             width:"100px",
//             height:"100px",
//         },2000)
//         //this one will work after the last one work
//         $(".animat").animate({
//             width:"300px",
//             height:"200px",
//         },2000)
        


// })


/*
********************************************************************************************************************************
*******************************   Effects - Chain V8 last ***************************************
********************************************************************************************************************************
*/
//chain the effects 
// $(document).ready(function(){
//     $("div")
//     .css({backgroundColor:"blue",width:"600px"})
//     .fadeOut(2000)
//     .fadeIn(2000) // chained instad of doing each effect in one line we put one after another
// })




/*
********************************************************************************************************************************
******************************* html Set/Get elemnt and attriebute V9 ***************************************
********************************************************************************************************************************
*/
// $("h1").text() : get the textcontent and turn any html into blain text of a elements and you can shoose another elemnt insaid the () in text to put the textcontent in it
// $("h1").html() : get the textcontent and respect  the html elemnt of a elements and you can shoose another elemnt insaid the () in text to put the textcontent in it
// $("input").val() : get the value of an element like input text or something 
// $("a").attr("href") : get the attribute value of an element like href attribute from a link
// $("a").attr("href","https://google.com") : get the attribute value of an element like href attribute from a link and you can change it or set a new one



// $(document).ready(function(){
//     var div = $("h1").text()
//     $(".p1").text(div) // we got the elemnt p then we put div in its text content
//     var text = $("h1").html()
//     $(".p2").text(text) // if you get the elemnt as html() then put it in text() its skipped the html element and write them as an text
//     $("button").click(function(){
//         // val for value when we click a button in this exmple its will put div in its value
//         $("input").attr("name","sami")
//         $("input").attr({
//             "name":"yahya",
//             "value":"sami"
//             //you can change multiple things at ones
//         })

//         $(".p3").text(`hello ${$("input").attr("name")}`)

    
//     })
// })


/*
********************************************************************************************************************************
*******************************  - Html - Append / AppendTo / Prepend / PrependTo / Before / After V11 ***************************************
********************************************************************************************************************************
*/
// $(document).ready(function(){
//     // append : to add element to the end of the parent element 
//     // $("div.cont").append("<p>hello yahya</p>") 
//     // prepend : to prepend element to the start of the parent element
//     // $("div.cont").prepend("<p>hello yahya</p>") 
//     // before : to add element before the target element
//     // $("div.cont").before("<p>hello yahya</p>") 
//     // after : to add element after the target element
//     // $("div.cont").after("<p>aye my nigga</p>","<span>this is span</span>") //btw all of them can you add more then one thing at ones
//     //in this next to you can add more then just the elemnt
//     // appendTo : to add element to the end of the target element but in this one you start with elemnt you want to add
//     // $("<p></p>",{
//     //     text:"yahya jquery",
//     //     class:"test"
//     // }).appendTo("div.cont")
//     // prependTo : to add element to the end of the target element but in this one you start with elemnt you want to add
//     // $("<p>this is preprendTo paragraphe</p>").prependTo("div.cont")
// })





/*
********************************************************************************************************************************
*******************************  Html - Remove / Empty Element V12 ***************************************
********************************************************************************************************************************
*/
// $(document).ready(function(){
//     $("button").click(function(){
//         // // remove the elemnt completely from the html file and in the remove(you can put here a class or somthing to specify what you want to delete)
//         // $("div").remove(".test")
//         //  $(".test").fadeOut(2000,function(){
//         //     $(this).remove()
//         //  })
//         // $("p").remove(":contains('remove')") // here we are removing any p that contains 'remove'
//         // empty : to remove all child element from the parent element but keep the element in the html and even if it just a text its will get removed as will
//         // $(".test").empty()
//     })
// })

/*
********************************************************************************************************************************
*******************************  - Html - Dealing With Css Classes V13 ***************************************
********************************************************************************************************************************
*/
// $(document).ready(function(){
//     $("button").click(function(){
//     //     // addClass : to add class to an element
//         // $("p").addClass("test")
//     //     // you can add the class to more then one element 
//         // $("p,span").addClass("test")
//     //     // removeClass : to remove class from an element and you can also remove the class to more then one element
//         // $("p").removeClass("test")
//         // $("p").removeClass() // will remove all classes from the element
//     //     // toggleClass : to toggle class between adding and removing it
//         // $("p,span").toggleClass("test")
//     //     // hasClass : to check if an element has a specific class
//         // if($("p").hasClass("test")){
//         //     console.log("p has class test")
//         // }else{
//         //     console.log("p has not class test")
//         // }
        
//     // // chaine stuff
//     $("p").removeClass("test").addClass("love");
//     })
// })



/*
********************************************************************************************************************************
*******************************  - Html - Css Get / Set V14 ***************************************
********************************************************************************************************************************
*/
// $(document).ready(function(){
//     $("button").click(function(){
//         //to get the value of an element in css
//         var color = $(".test").css("color");
//         var back = $(".test").css("background-color");
//         // to set it
//         $("span").css({
//             "color": color,
//             "background-color":back
//         })
//     })
// })
/*
********************************************************************************************************************************
*******************************  - Html - Dimensions V15 ***************************************
********************************************************************************************************************************
*/
//getting the width of the page or any elemnts you want and change it as will
//width() get you the width of the element and ignore outstuff like padding and border
//innerWidth() get you the width of the element and includes outstuff like padding 
//outerWidth() get you the width of the element and includes outstuff like padding and also border
//outerWidth(true) if true get you the width of the element and includes outstuff like padding and also border and the margin as well
///////////// ALL THE THINGS IN THE WIDTH IS THE SAME WITH HEIGHT ///////////////////

// $(document).ready(function(){
//     // to get the width of the element you want
//         var width = $(document).width();
//         $("span").text(width);  
//     //to change the width of the element you want
//     $(".width").click(function(){
//         //this one is to keep adding 100px in each click
//         $(this).width("+="+100)
//         $(this).width("100%")
//         $(this).text($(this).width())
//     })
    
// })
/*
********************************************************************************************************************************
*******************************  Traversing - Parent / Parents / ParentsUntil V16 ***************************************
********************************************************************************************************************************
*/

// moving through elements
// $(document).ready(function () {
//     // to get the parent of the elemnt in this case we have span in a paragraph
//      $("span").parent().css("border-color","red");
//     // to get the all the elements parent of the elemnt and we can search by class as will
//      $("span").parent().css("border-color","red");
//      $("span").parent(".test").css("border-color","red");
//      //here its will apply the css to all elements entil its get to the elemnt you schoose in this case .test 
//      $("span").parentUntil(".test").css("border-color","red");
// });


/*
********************************************************************************************************************************
*******************************  Traversing - Children / Find V17 ***************************************
********************************************************************************************************************************
*/
//$("selector").children() : will get you all the children in the selector but only the ones on the same level so if you have a section insaid of if a div that has content its will not return the content insaid that div and you can select 
// document.querySelector("#test").showModal();
// $("section").find("span").css("background","red"); : find wil lsearch even insaid the elements that are insaid the main element
// $(document).ready(function () {
//   $("section").find("span").css("background","red");
//   $("section").children("span").css("background","red");
// });



/*
********************************************************************************************************************************
*******************************  Traversing - Siblings / Next / Previous V18 ***************************************
********************************************************************************************************************************
*/
//siblings : select all elemnt that a sibling to the selected element and you can add a selector to get one element

//next : select the next sibling to the selected element to down
//nextAll : select all elemnt that a sibling to the selected element
//nextUntil : select all elemnt that a sibling to the selected element until you get to the elements you want to stop at

//previous : select all elemnt that a sibling to the selected element to up
//previousAll : select all elemnt that a sibling to the selected element to ap
//previousUntil : select all elemnt that a sibling to the selected element until you get to the one you want to up
// $(document).ready(function() {
//   $("div,p").click(function(){
    // $(this).siblings().toggle(1000);
    // $(this).siblings().slideToggle(1000);
    // $(this).siblings(".test").slideToggle(1000);
    // $(this).nextUntil("p").css("border","2px solid black") // after we click a div or p all the elemnts after it will have this css until its get to a paragraph that has p3 in it content its will not effect him but will stop at it
    // $(this).next().css("border","2px solid black")  // goes by one elemnts at a time
    // $(this).nextAll().css("border","2px solid black")  // all the elemnts after the one i clicked
    //  $(this).prevUntil("p:contains('p1')").css("border","2px solid black") // after we click a div or p all the elemnts that are previous to it will have this css until its get to a paragraph that has p3 in it content its will not effect him but will stop at it
    // $(this).prev().css("border","2px solid black")  // goes up by one elemnts at a time
    //  $(this).prevAll().css("border","2px solid black")  // all the elemnts previous the one i clicked
  // })
  // $("p:contains('yahya')").next().css("border","2px solid red")
// })




/*
********************************************************************************************************************************
*******************************  Traversing - First / Last / Eq / Filter / Not V19 ***************************************
********************************************************************************************************************************
*/
//in filter and not we can use functions and jqeruy selector
// $(document).ready(function(){
  // $("div").first().css("background","red"); //get the first div in the document  
  // $("div").last().css("background","blue"); //get the last div in the document  
  // $("div").eq(-1).css("background","green"); //get the ELEMNT THAT HAS THE SAME INDEX in this one we deal with the elemnt as a array indexed
  // $("div").filter(function(element){
  //   return element === 7; // here since we pass the divs and as we said they are like indexed so the element has an index
  // }).css("background","green");
  // $("div").not(".test").css("background","yellow")
// })


/*
********************************************************************************************************************************
*******************************  Selectors Reference Part 1 V20 ***************************************
********************************************************************************************************************************
*/
/**
 * $("*") :: to select evrey thing in the document
 * $(".class2,.class3") :: we can use more then one class at once
 * $("p:first") :: the first p in the document just in this case at list
 * $("p:last") :: the last p in the document just in this case at list
 * $("p:even") :: select the p with the even index like 2 4 6...
 * $("p:odd") :: select the p with the odd index like 1 3 5...
 */

/*
********************************************************************************************************************************
*******************************  Selectors Reference Part 2 V21 ***************************************
********************************************************************************************************************************
*/

/**
 * $("p:first-child") :: select the first p with the parent element
 * $("p:last-child") :: select the last p with the parent element
 * $("p:first-of-type") :: select the first element with the type of p 
 * $("p:last-of-type") :: select the last element with the type of p 
 * $("p:nth-child(2)") :: select the second element with the type of p
 * $("p:nth-last-child(2)") :: select the second element with the type of p but for down to top
 * $("p:nth-of-type(2)") :: select the second element with the type of p but here we are not counting the other elements we are just counting the p's
 * $("p:nth-last-of-type(2)") :: select the second element with the type of p but here we are not counting the others elements we are counting the p's but from dow to up
 */

/*
********************************************************************************************************************************
*******************************  Selectors Reference Part 3 V22 ***************************************
********************************************************************************************************************************
*/

/**
 * $("p:only-child") :: select the p if it the only child that an element has if yuo have some effect and you have more the one p its will not work at all
 * $("p:only-of-type") :: select only elements that is the type p if  there is more then one its will not work
 * $("div > p") :: select the dairect child of an element the p in this case should be directly in the div not insaid something in the div 
 * $("div + p") :: select p that comes directly after a div
 * $("li:eq(0)") :: select the li that is eaquel to 0
 *  $("li:gt(1)") :: select the li that are greater then 1
 *  $("li:lt(1)") :: select the li that are less then 1
 * $("li:not(:contains('3'))") :: select the li that that do not has the 3 in it text content
 */
/*
********************************************************************************************************************************
*******************************  Selectors Reference Part 4 V23 ***************************************
********************************************************************************************************************************
*/
// $(":header").css("color","red")
// $(":animated").css("color","red") :: this one will effect all the stuff that has animate in it or its haning to it
// $(":focus") :: its will effect the focus elements
// $("div:contains('love')") :: its will effect the divs that has the love in there content
// $("div:has('span')") :: select any div that has a p in it
// $("div:empty") :: select all divs that are empty elements 
// $("div:parent") :: select all divs that are parent elements in other words has childern
// $(":hidden") :: select all divs that are hidden elements has display none on 
// $(":visible") :: select all divs that are visible elements has display none on 

/*
********************************************************************************************************************************
*******************************  Selectors Reference Part 5 V24 ***************************************
********************************************************************************************************************************
*/
// $("[src]") :: select all elements who has a src attrebute
// $("[title]") :: select all elements who has a title attrebute
// $("img[alt = 'gg']") :: select all images who has a alt attrebute with the value of 'gg'
// $("img[alt != 'gg']") :: select all images who doesn't has a alt attrebute with the value of 'gg'
// $("img[alt *= 'gg']") :: select all images who does has a alt attrebute that contains 'gg'
// $("img[alt ^= 'gg']") :: select all images who does has a alt attrebute that starts with  'gg'
/*
********************************************************************************************************************************
*******************************  Selectors Reference Part 6 V25 ***************************************
********************************************************************************************************************************
*/
// $(":input") :: select all inputs
// $(":text") :: select all inputs type text the same with all inputs
// $(":disabled") :: select all inputs that are disabled
// $(":enabled") :: select all inputs that are enabled you can write on it
// $(":checked") :: select all inputs that are checked
// $(":selected") :: select all inputs that are selected



/*
********************************************************************************************************************************
*******************************   Events Reference - Bind() V26 ***************************************
********************************************************************************************************************************
*/
//bind(event , data ,function , map) :: can bind more the one event

// $("button").bind("click mouseenter",function(){
//   console.log("hello")
// })
//custom event create an event for something and trigger it when needed here is a custom event for the p that is triggered when a button is preesed
// $("p").bind("customeevent",function(event,name,age){
//   $(this).text("hello" + name + "your age is " + age);
// })
// $("button").click(function(){
//   //you can pass data like this [""]
//   $("p").trigger("customeevent",["yahya",20]);
// })
/*
video 27 and 29 live and delegate function got removed
********************************************************************************************************************************
*******************************   Events Reference - On() V29 ***************************************
********************************************************************************************************************************
*/
//on(event, childe selector, date, function, map) you can pass the parent first then the child as you can see or you can just use the childe
// $("p").on({
//    click: function(){console.log("hello one ")},
//    mouseenter: function(){console.log("hello two ")}
// })

//custom event create an event for something and trigger it when needed here is a custom event for the p that is triggered when a button is preesed
//  $("div").bind("customeevent","p",function(event,name,age){
//    $(this).text("hello " + name + " your age is " + age);
//  })
// $("button").click(function(){
//   //you can pass data like this [""]
//   $("p").trigger("customeevent",["yahya",20]);
// })
// $("button").on("click",function(){
//   $("<p class='remove'>this has to be deleted</p>").insertAfter(this);
// })
// $("body").on("click",".remove",function(){
//   $(this).remove();
// })
/*
********************************************************************************************************************************
*******************************  Events Reference - PreventDefault V30 ***************************************
********************************************************************************************************************************
*/
// $("button").on("click",".remove",function(event){
//   event.preventDefault();
//   if(event.isDefaultPrevented()){
//     console.log("the default action has been prevented");
//   }
// })

/*
********************************************************************************************************************************
*******************************  Events Reference - Keydown, Keypress, Keyup V31 KNOWNE ***************************************
********************************************************************************************************************************
*/
/*
********************************************************************************************************************************
*******************************  Events Reference - Change V32 KNOWNE ***************************************
********************************************************************************************************************************
*/
//CHANGE its will triger when somthing changes like a text of select in html
/*
********************************************************************************************************************************
*******************************   Events Reference - Focus, Blur V33 KNOWNE ***************************************
********************************************************************************************************************************
*/
// FOCUS : when you focus on an input field
// BLURE : when you leave the  input field


/*
********************************************************************************************************************************
*******************************  Events Reference - One V34 ***************************************
********************************************************************************************************************************
*/
//one() :: event will happened one time and if you use more then one event all of them will work only one time 
// $("button").one("click mouseover",function(){
//    $("p").animate({
//     fontSize: "+=100px"
//    })
// })



/*
********************************************************************************************************************************
******************************* Events Reference - Select V35 ***************************************
********************************************************************************************************************************
*/
//select() :: is like when you want to copy somthing
//here when we click the textarea and select the text
// $("textarea").on("click",function(){
//   $(this).select();
// })
// //here we trigger the function after we select
// $("textarea").select(function(){
//   console.log("the text is selected");
// })


/*
********************************************************************************************************************************
******************************* Events Reference - Resize() V36 ***************************************
********************************************************************************************************************************
*/
// $(window).on("resize",function(){
//   let wid = $(window).width();
//   // console.log($(window).width())
//       $("textarea").width($(this).width() - 100)
//       $("textarea").height($(this).height() - 400)
// })

/*
********************************************************************************************************************************
******************************* Events Reference - Scroll() V37 ***************************************
********************************************************************************************************************************
*/
// $(window).on("scroll",function(){
//   console.log("Scroll")
// })

// $("button").on("click",function(){
//   console.log($(window).scrollTop()) // gave you the space between the place you are in and the space above it

// })

/*
********************************************************************************************************************************
******************************* Events Reference - PageX PageY V38 ***************************************
********************************************************************************************************************************
*/
//PageX - PageY :: are the x and y accses of the mouse its really useful for style like somthing following the mouse or something
// $(document).ready(function(){
//   $("html").mousemove(function(e){
//     $(".follow").offset({ // offset allow you to reposition stuff withpout need of position
//       left: e.pageX + 5,
//       top: e.pageY + 5,
//     })
//   })
// })
// $(document).ready(function(){
//   $("html").click(function(e){
//     $(".follow").offset({ // offset allow you to reposition stuff withpout need of position
//       left: e.pageX + 5,
//       top: e.pageY + 5,
//     })
//   })
// })
/*
********************************************************************************************************************************
******************************* Events Reference - Submit V39 KNOWEN ***************************************
********************************************************************************************************************************
*/
/*
********************************************************************************************************************************
******************************* Effects Reference - Delay V40 ***************************************
********************************************************************************************************************************
*/
// delay() :: can get second like 5000ms or string like "slow" or "fast"
// $("button").on("click",function(){
//   $("p").text("this text will be gone in 5s remamber it").fadeIn().delay(5000).fadeOut();
// })
/*
********************************************************************************************************************************
******************************* Html/Css Reference - Clone V41 ***************************************
********************************************************************************************************************************
*/
//clone(true or false) fasle : default value clone a thing without its event , true clone the thing with its event
// $("button").click(function(){
//   $("div").append($(".hh").clone())
//   // $("p").clone().appendTo()
// })
/*
********************************************************************************************************************************
******************************* Html/Css Reference - Detach V42 ***************************************
********************************************************************************************************************************
*/
//the diffrents between remove and detach that when you use remove you remove the whole elemnt with its events unlike detach
//detach() :: keep the events for exmple if we detached an element with an event and save it in a variable then we use again with append or prepend its will be put again with the event that its hold 

// $("li").each(collection, function (indexInArray, valueOfElement) { 
   
// });
/*
********************************************************************************************************************************
******************************* Html/Css Reference - Has Class V43 ***************************************
********************************************************************************************************************************
*/
// if($("p").hasClass("hh")){
//   console.log("yes this p has that class")
// }else{
//   console.log("no this p does not have that class")
// }
/*
********************************************************************************************************************************
******************************* Html/Css Reference - Offset V44 ***************************************
********************************************************************************************************************************
*/
//offset is qn object that has left and right since its an object we can do like this $("div").offset().left = 10 this will make the div move to the left by 10px

/*
********************************************************************************************************************************
******************************* Html/Css Reference - Position V45 ***************************************
********************************************************************************************************************************
*/
//position is the same as offset but offset values get effected by the margin and padding of the body since offset values are like an absoulot
// but poisiton gave you the left and top from the elements its self so if you have a div with left 100px and top 10px and the parent has a margin 
// of 100 the position values will still 100 px left and 10px top


/*
********************************************************************************************************************************
******************************* Html/Css Reference - Prop V46 ***************************************
********************************************************************************************************************************
*/
//Prop() :: allowes you to get properties and change its values
// $("input").prop("value","yahya");
// $("input").prop({ // here we are setting multiple properties at ones
//   value: "yahya",
//   id: "gg"
// });
// console.log($("input").prop("disabled")) // here we are showing what is the value of the property disabled
/*
********************************************************************************************************************************
******************************* Html/Css Reference - Replace With V47 ***************************************
********************************************************************************************************************************
*/
//replace() :: replace the content of an element with something you want and remove events from it
// $("div").replaceWith("hello yahya")

/*
********************************************************************************************************************************
******************************* Html/Css Reference - Scroll [ Top / Left ] V48 ***************************************
********************************************************************************************************************************
*/
// $(window).on("scroll",function(){
//   console.log($(this).scrollTop())
//   console.log($(".test").offset().top)
//   if($(this).scrollTop() >= $(".test").offset().top){
//     $(".test").animate({
//       opacity: "100%",
//     },4000)
//     $(".test").offset().top = 20;
//   }
// })
// $(window).scrollTop(700); // to scroll t a specific place

/*
********************************************************************************************************************************
******************************* Html/Css Reference - Wrap V49 ***************************************
********************************************************************************************************************************
*/
//wrap() add domthing to something like this
// $("span").wrap("<div></div>") // here all spans will wraped insaid a dic like this <div><span>hhh</span></div>
// $("span").anwrap() // here all we do the oposet 

/*
********************************************************************************************************************************
******************************* Traversing Reference - Each V50 ***************************************
********************************************************************************************************************************
*/
//you know it foreach loop
// $("li").each(function(){
//   if($(this).hasClass("hoho")){
//     $(this).css("background-color","red")
//   }
// })


/*
********************************************************************************************************************************
******************************* Traversing Reference - Has V51 ***************************************
********************************************************************************************************************************
*/
// $("p,div,h1").has(".test,span").css('background',"red")
// let a = $("p,div,h1");
// console.log(a)


/*
********************************************************************************************************************************
******************************* Traversing Reference - Is V52 ***************************************
********************************************************************************************************************************
*/
//is() is used to check anyting you want elements class or even attributes
// $("span").on("click",function(){
  // if($(this).parent().is("div,p")){
  //   console.log("there div")
  // }else{
  //   console.log("there not div")
  // }
  // if($(this).parent().is(".test")){
  //   console.log("there is a  with class test")
  // }
  
// })
// if($("div").children().is("span")){
//   console.log("there is a span child")
// }


/*
********************************************************************************************************************************
******************************* Traversing Reference - End V53 ***************************************
********************************************************************************************************************************
*/
//end() stop the chain events and start a new one for exmple searching in the same div twice will not work unless you used end

// $("div").find("span").css("color","green").end().find("h2").css("color","gray")



/**
 ****************************************************************************************
 **************************XHR part 1 ReadyState & Status Codes v3 ******************************************
 ****************************************************************************************
 */

 //xhr : [X]ML [H]ttp [R]rquest
 // step 1 we are creating the new XMLHttpRequest() object
//  let newReq = new XMLHttpRequest();
// here we are saying that when the status of the request is changed do this function
//  newReq.onreadystatechange = function(){
    // console.log(this.readyState)
    /**
     * readyState => state of the request and its goes from 0 to 4
     * [0] => not anitlazed
     * [1] => server connection done
     * [2] => request revieved
     * [3] => processing the reqeust
     * [4] => the request is done and the response is ready
     */
    // if(this.readyState === 4 && this.status === 200){
    //     console.log(this.responseText)
    //     // console.log(newReq)
    // }

//  }

 // here we are putting the sittings like the request method and the link that we are going to get stuff from and the aysnc on not state
//  newReq.open("GET","lol.txt", true);
 // here we are sending the request
//  newReq.send();


 /*
 ****************************************************************************************
 **************************XHR part 2 Open & Send v4 ******************************************
 ****************************************************************************************
 */
//remamber that the files that you get data from need to be on the same sarver or some issues my acure
/**
 * XMLHttpRequest.open(
 *  Methode = POST or GET how we get the content,
 *  URL = link like https://api.github.com/users/belhadj-yahya/repos or lol.txt,
 *  async = this will be eather true or false if it true that means that nothing should happend until this request is done and false does apposet,
 *  User = used if something need to sign in or somthng like that and its optionl,
 *  Password = used if something need to sign in or somthng like that optionl,
 * )
 */



 /*
 ****************************************************************************************
 ************************** Convert Response Text and loop on it v5 ******************************************
 ****************************************************************************************
 */ 
//the response always come as a full string  to convert it to javascript code we use JSON.parse(request.responseText)
// let second = new XMLHttpRequest();

// second.onreadystatechange = function(){
//     if(this.readyState === 4 && this.status === 200){
//     //    console.log(this.responseText)
//     //    console.log(JSON.parse(this.responseText));
//        let a = JSON.parse(this.responseText);
//        let test_text = '';
//        for(let i = 0;i < a.length;i++){
//         console.log(a[i].userName)
//         test_text += a[i].userName + "\t";
//        }
//        console.log(test_text)
//     }
// }
// second.open("GET","data.json",true);
// second.send();
 

 /*
 ****************************************************************************************
 ************************** Test Get & Post With PHP v6 ******************************************
 ****************************************************************************************
 */ 
// let btn = document.querySelector("button");
// btn.addEventListener("click",function(){
    // let value = document.querySelector(".name").value
    // let last_loging = new Date().toDateString();
    // let masseg = new XMLHttpRequest();
    // masseg.onreadystatechange = function(){
        // if(this.readyState === 4 && this.status === 200){
            // console.log(masseg.responseText)
        // }
        
    // }
    //GET
    // masseg.open("GET",`index.php?name=${value}&date=${last_loging}`,true); 
    // masseg.send();
    //POST
    // masseg.open("POST",`index.php`,true); //POST
    //this is to specify type of data that we are sending sending  and its need to always be after the open 
    // masseg.setRequestHeader("Content-type","application/x-www-form-urlencoded")
    // "Content-type","application/x-www-form-urlencoded" mostly use for form data
    // masseg.send(`name=${value}&date=${last_loging}`)
   
// })


/*
**********************************************************************************************
***************************  jQuery - Ajax Load v7  ********************************************
**********************************************************************************************
*/
//the load function call has 3 parametars by default 
/**
 * first parametar : response text what you asked for
 * second parametar: status code you know it if the request is success or not
 * thered parametar: XHR object the saaame one that is the MXHRttpRequest(); 
 */
// $(document).ready(function(){
//     $("button").on("click",function(){
//         $(".show").load($(this).data("page") + " .content",function(respostText,status,XHRobj){
//             if(status === "success"){
//               console.log("data is loaded")
//             }
//           }) //load call another file to this page and you can specify what you want and you can add a callback function
//     })
// })

/*
**********************************************************************************************
***************************  jQuery - $.get & $.post v8  ********************************************
**********************************************************************************************
*/

// $("button").on("click",function(){
//$.get('url',callback function())
    // $.get("index.php?name=yahya&date=yestrday",function(one,two,three){
    //     console.log("this is GET")
    //     console.log(one)
    //     console.log(two)
    //     console.log(three)
    // })
//$.post('url',data,callback function())
//     $.post("index.php",{name: "yahya",date:"today"},function(one){
//         console.log("this is POST")
//         console.log(one)
//     })
// })


/*
**********************************************************************************************
***************************  jQuery - $.Ajax Part 1  v9  ********************************************
**********************************************************************************************
*/

/**
 * $.ajax({
 *  method: "POST", //method used for the request
 *  url: "index.php", // the url that we will send the request to and if it empty the url will be the same page
 *  data: {name:"yahya",date: "1 weak ago"},
 *  success: function(one, two , three){ // function to run when the request is success
 *    consoel.log(one)
 *    consoel.log(two)
 *    consoel.log(three)
 * }
 * }),
 * error: function(xhr object,state,error){ // function to run when the request failed
 * }
 */
// $("button").on("click",function(){
//     $.ajax({
//         method: "POST",
//         url: "inde.php",
//         data: {name:"yahya",date: "2 days ago"},
//         success: function(data , state , xhr){
//            console.log(data)
//            console.log(state)
//            console.log(xhr)
//         },
//         error: function(xhr,state,error){
//             console.log(xhr)
//             console.log(state)
//             console.log(error)
//         }

//     })
      
// })

/*
**********************************************************************************************
***************************  jQuery - $.Ajax Part 2 & 3 v10 & v11  ********************************************
**********************************************************************************************
*/
$("button").on("click",function(){
    $.ajax({
        /*
        remamber:
        type: "same as method does the same thing its jsut that method: is an elyas and there is no diffrent".
        */
        // timeout: 3000, // timeout can be verey useful when you have a lot of request like one with time out of 0 and the second one with timeout of 3000 the one with 0 will work first so that we dont have a problem
        // dataType: 'html', //data expected from the server default is Intel guess this type you let the jquery guess the type 
        // userName: "yahya", // for authentication
        // userPassword: "yahya678", // for authentication
        // contentType:"", // content type for the request, default is application/x-www-form-urlencoded
        method: "POST",
        // cache: false, // by default true some times you dont need the request to return the same data whnere thre is new data that just comed in other words cashes make sure that data is not outdatesed
        // async: false, // work as async or not
        // v11 functions start here
        /**
         * $.ajaxSetup({
         *  url: "ping.php"
         * })
         * here we sont have a url soo from that ajaxsetup its will use its url
         * $.ajax({
         * data:{name:"yahya"}
         * })
         * to strop it from use in it you do here its will not use the globel set up that was set
         * $.ajax({
         * url:"index.php",
         * global:false,
         * data:{name: "yahya"}
         * })
         * 
         */
        beforeSend: function(xhr){
            console.log("before send")
            console.log(xhr)
        },
        url: "index.php",
        data: {name:"yahya",date: "today"},
        success: function(data){
          console.log(data)
        },
        error: function(xhr,state,error){
            console.log("whene error")
            console.log(error)
        },
        complete: function(xhr , state){ // function to run when the reqest is completed
            console.log("this is at the end")
          console.log(xhr)
          console.log(state) 
        }
    })
})
/*
**********************************************************************************************
***************************  jQuery - $.Ajax Part 3 v11  ********************************************
**********************************************************************************************
*/

var xhr = new XMLHttpRequest();
xhr.open('POST', 'yourfile.php', true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

xhr.onreadystatechange = function() {
  if (xhr.readyState === 4 && xhr.status === 200) {
    console.log(xhr.responseText);  // Handle the response from PHP
  }
};

var data = 'name=John&age=30';  // Data to send
xhr.send(data);

/*GET DATA WITH FROM JSON FILE*/
$.getJSON('data.json', function(data) {
  console.log(data);
});



