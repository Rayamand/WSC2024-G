async () => {
    let categoryReq = await fetch(`http://ws04.worldskills.org/category`);
    let categoryRes = await categoryReq.json();
    let categoryData = categoryRes.data;

    let restaurantReq = await fetch(`http://ws04.worldskills.org/restaurant`, {
        method: "POST",
        body: {
            open: false,
            category: 1,
            latitude: 0,
            longitude: 0
        }
    });
    let restaurantRes = await restaurantReq.json();
    let restaurantData = restaurantRes.data;


    let singleRestaurantReq = await fetch(`http://ws04.worldskills.org/restaurant/slug`);
    let singleRestaurantRes = await singleRestaurantReq.json();
    let singleRestaurantData = singleRestaurantRes.data;
}