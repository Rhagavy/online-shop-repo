/**
 * Code allows user add items to their cart, adjust the quantity, delete items and also
 * buy what ever item is in their cart.
 * I, Rhagavy Rakulan, 000802106 certify that this material is my original work.  
 * No other person's work has been used without due acknowledgement. 
 *
 * Name: Rhagavy Rakulan, Student#: 000802106
 * Date created: Monday, November 30, 2020
 */

//wait for page to load
window.addEventListener("load", function(){
    //event listners for add to cart buttons
    let itemButton = document.querySelectorAll(".button");
    itemButton.forEach(function(button){
        button.addEventListener("click",addToCart)
    });
    
    savedItems();
    /**
     * will add item to the specifc user's cart based on the item they clicked 
     * @param {*} event 
     */
    function addToCart(event) {
        console.log(event.target.id);
        //store the item that user clicked
        let itemClicked = event.target.id;
        console.log(itemClicked);
        let userName = document.getElementById("username").textContent;
        console.log(userName);

        
        // itemPicked and username are sent to additem.php
        let url = "server/additem.php?item="+itemClicked+"&userName="+userName;
        console.log(url);

        //add item to this user's cart or update quantity
        fetch(url, { credentials: 'include' }).catch(err => console.error(err));

        //then get the item as array
        let url2 = "server/getitem.php?userName="+userName;

        console.log(url2);
        fetch(url2, { credentials: 'include' })
            .then(response => response.json()) 
            .then(showItem)
            .catch(err => console.error(err));

    }
    /**
     * will load any item the user still had in their cart that they haven't
     * bought yet
     */
    function savedItems(){
        //store username
        let userName = document.getElementById("username").textContent;
        let url = "server/getitem.php?userName="+userName;
        console.log(url);

        fetch(url,{ credentials: 'include'})
        .then(response => response.json())
        .then(showItem)
        .catch(err=> console.error(err));

    }
    //show item after add cart is clicked
    /**
     * will allow the user to see what is in their cart and the toal cost. If the cart
     * is empty, then the DOM will be changed to state that the cart is empty.
     * @param {*} item 
     */
    function showItem(item){
        let entireCart = "";
        //store total cost
        let totalCost = 0;
        
        if(item.length!== 0){
            console.log(item.length)
            for(let i = 0; i<item.length;i++){
                entireCart+= itemToHtml(item[i]);
                totalCost += totalPrice (item[i]);
                console.log(item);
            }
            document.getElementById("cartofuser").innerHTML = entireCart;
            document.getElementById("total").innerHTML = "Total Cost: "+totalCost+" bells";
        } else{
            document.getElementById("cartofuser").innerHTML = "Your cart is currently empty...";
            //location.reload();
        }

        // let totalForItem = itemPrice*quantity;
        // console.log(totalForItem);
        // let html = `
        // <div>
        //     <li class="items" id="cart ${item.itemname}"></li>
        // </div>
        // `;
    }
    /**
     * will help convert each of the user's item in the shopping cart table into html
     * @param {*} item 
     */
    function itemToHtml(item){
        //item id
        let id = item.itemId;
        //quantity of item
        let quantity = item.quantity;
        //name of item
        let itemName;
        let itemPrice = 0;

        if (id == "1"){
            itemName = "Apple";
            itemPrice = 100;
        }else if (id == "2"){
            itemName = "Pumpkin";
            itemPrice = 120;
        }else if (id == "3"){
            itemName = "Grass";
            itemPrice = 140;
        }else if (id == "4"){
            itemName = "Shovel";
            itemPrice = 140;
        }else if (id == "5"){
            itemName = "Pear";
            itemPrice = 160;
        }else if (id == "6"){
            itemName = "Umbrella";
            itemPrice = 180;
        }

        let totalForItem = itemPrice*quantity;
        console.log(totalForItem);
        totalPrice(totalForItem);
        console.log(totalCost);

        let html = "<div class = 'cartitem'>";
        html += "<li class='items' data-item="+ id +">"+itemName+"</li>";
        html+= "<input readonly class='itemquantity' data-item="+ id +" value="+quantity+"></input><p class='cost'>Cost of item: "+totalForItem+" bells</p>";

        html+= "<button class='increase' data-item="+id +">+</button>";
        html+= "<button class = 'decrease' data-item="+id +">-</button>";
        html+= "<button class = 'delete' data-item="+id +">Delete</button>";
        html += "</div>";

        return html;
    }

    //parent of all cart elements
    let parent = document.getElementById("cartofuser");
    parent.addEventListener("click", buttonClicked)
    /**
     * based on the button that was clicked the data attribute will be used to 
     * either delete a specific item from the cart, increase the quanity or decrease the
     * quantity of a specific cart item.
     * @param {*} event 
     */
    function buttonClicked(event){
        //let itemClicked = event.target.getAttribute("data-item").value;
        let clickedItemId = event.target.getAttribute('data-item')
        //store username
        let userName = document.getElementById("username").textContent;
        console.log(event.target.getAttribute('data-item'));
        let url2 = "server/getitem.php?userName="+userName;
        console.log(url2);
        //if delete button was clicked
        if(event.target.className == 'delete'){
            console.log("delete");
            
            let url = "server/deleteitem.php?item="+clickedItemId+"&userName="+userName;
            console.log(url);
            
            fetch(url, { credentials: 'include' })

            //fetch the cart after delete
            fetch(url2, { credentials: 'include' })
            .then(response => response.json()) // calls the json function instead of text
            .then(showItem)
            .catch(err => console.error(err));

        }//if decrease button was clicked
        else if (event.target.className == 'decrease'){
            console.log("decrease");

            let url = "server/decreaseitem.php?item="+clickedItemId+"&userName="+userName;
            console.log(url);

            fetch(url, { credentials: 'include' })

            //fetch cart after decrease quantity
            fetch(url2, { credentials: 'include' })
            .then(response => response.json()) // calls the json function instead of text
            .then(showItem)
            .catch(err => console.error(err));

        }//if increase button was clicked
        else if(event.target.className == 'increase'){
            console.log("increase");

            let url = "server/increasequantity.php?item="+clickedItemId+"&userName="+userName;
            console.log(url);

            fetch(url, { credentials: 'include' })

            //fetch cart after increase quantity
            fetch(url2, { credentials: 'include' })
            .then(response => response.json()) // calls the json function instead of text
            .then(showItem)
            .catch(err => console.error(err));

        }
        
    }
    //add event listner to the buy cart button
    let buyButton = document.getElementById("buycart");
    buyButton.addEventListener("click",buyCart)

    /**
     * will check if user has anything in their cart and pass the items to 
     * checkCart function
     */
    function buyCart(){
        //check to see user has items in cart
        let userName = document.getElementById("username").textContent;
        //if items in cart are present then delete them

        let url = "server/getitem.php?userName="+userName;
        //let url2 = "server/getitem.php?item="+itemClicked+"&userName="+userName;
        console.log(url);
        fetch(url, { credentials: 'include' })
            .then(response => response.json()) // calls the json function instead of text
            .then(checkCart)
            .catch(err => console.error(err));
        //else change DOM to let them know they need to add items to cart before they click buy
    }

    /**
     * if the user has anything in cart then the purchase will be made(items get deleted). Other
     * wise the user will be notified to add an item to cart.
     * @param {*} item 
     */
    function checkCart(item){
        let userName = document.getElementById("username").textContent;
        console.log(item.length);
        if(item.length>0){
            //delete the items of this user
            let url = "server/emptyusercart.php?userName="+userName;
            fetch(url, { credentials: 'include' });


            let url2 = "server/getitem.php?userName="+userName;
            //let url2 = "server/getitem.php?item="+itemClicked+"&userName="+userName;
            console.log(url2);
            fetch(url2, { credentials: 'include' })
            .then(response => response.json()) 
            .then(purchaseComplete)
            .catch(err => console.error(err));

        }else{
            document.getElementById("cartofuser").innerHTML = "Your cart is empty! Add an item to the cart before you click buy...";
        }
    }
    /**
     * inner HTML is changed to show whether the purchase was successful or not
     * @param {*} item 
     */
    function purchaseComplete(item){
        console.log(item.length);
        if(item.length === 0){
            document.getElementById("cartofuser").innerHTML = `Thank you for your purchase! We have taken the
            bells out of your ABD account. Your items will be at your door steps in the morning!`;
            document.getElementById("total").innerHTML = "";
        }else{
            document.getElementById("cartofuser").innerHTML =`Uh oh! Could not complete purchase. Please try again later!`
            document.getElementById("total").innerHTML = "";
        }
    }

    let totalCost = 0;
    /**
     * calculate total cost of user's cart
     * @param {*} item 
     * @returns totalForItems
     */
    function totalPrice(item){
        let id = item.itemId;
        let quantity = item.quantity;
        //totalCost= totalCost+cost;

        let itemPrice = 0;

        if (id == "1"){
            itemPrice = 100;
        }else if (id == "2"){
            itemPrice = 120;
        }else if (id == "3"){
            itemPrice = 140;
        }else if (id == "4"){
            itemPrice = 140;
        }else if (id == "5"){
            itemPrice = 160;
        }else if (id == "6"){
            itemPrice = 180;
        }

        let totalForItem = itemPrice*quantity;
        return totalForItem;

    }

 

    

});
// $(document).ready(function(){

//     $("button").click(function(){
//        let itemPicked =  $(this).attr("id");
//        console.log(itemPicked);
//     });
    

