<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pizzas')->insert([
            [
                'name' => 'Cheese Bomb',
                'price' => 80000,
                'description' => "Pizza with mozarella cheese, tomato sauce, and another cheese",
                'image' => 'cheese.jpg'
            ],
            [
                'name' => 'Tuna Man',
                'price' => 100000,
                'description' => "Pizza with tuna, but don't worry there's no man inside",
                'image' => 'tunaandonion.jpg'
            ],
            [
                'name' => 'Classic Pepperoni',
                'price' => 80000,
                'description' => "Clasic pepperoni pizza with peppe and roni on top, it is delicious",
                'image' => 'pepperoni.jpg'
            ],
            [
                'name' => 'Lamb and Onion',
                'price' => 85000,
                'description' => "Pizza with lamb meat, some onion and cheese on top, coated with our special sauce",
                'image' => 'spicedlamb.jpeg'
            ],
            [
                'name' => 'Garlic Hectic',
                'price' => 90000,
                'description' => "Pizza night is made easy with this flavorful chicken and two-cheese pizza",
                'image' => 'garlicchicken.jpg'
            ],
            [
                'name' => "Bacon 'N Egg",
                'price' => 75000,
                'description' => "What could go wrong with bacon and egg for breakast? Absolutely nothing",
                'image' => 'baconandegg.jpg'
            ],
            [
                'name' => 'Hawaiian',
                'price' => 75000,
                'description' => "Pizza with sausages, cheese, and straight up Hawaii inside",
                'image' => 'hawaiian.jpg'
            ],
            [
                'name' => 'Beef Pepper',
                'price' => 70000,
                'description' => "Pizza with ground beef, onions and peppers, made beautifully",
                'image' => 'beefpepper.jpg'
            ],
            [
                'name' => 'Bufallo Chicken',
                'price' => 105000,
                'description' => "Perfect combination of buffalo and chicken, please don't chicken out!",
                'image' => 'buffalochicken.jpg'
            ],
            [
                'name' => 'Meatball Feast',
                'price' => 70000,
                'description' => "Meet the meatballs community on top of the pizza",
                'image' => 'meatball.jpg'
            ],
            [
                'name' => 'Mushroom Ricotta',
                'price' => 85000,
                'description' => "The cheese, garlic and red pepper flakes maximize flavor, and tossing the mushrooms with a little oil before baking gives them a boost while letting us cut down on fat",
                'image' => 'mushroomricotta.jpeg'
            ],
            [
                'name' => 'Spiced Lamb',
                'price' => 80000,
                'description' => "Pizza with lamb, spices, and a little bit of heat to beat the meat",
                'image' => 'spicedlamb.jpeg'
            ],
            [
                'name' => 'Supreme One',
                'price' => 120000,
                'description' => "It’s a true supreme pizza: bacon, pepperoni slices, red and green bell pepper, red onion, black olives, mozzarella, parmesan, and basil to make you feel supreme",
                'image' => 'supreme.jpg'
            ],
            [
                'name' => "Veggie Mania",
                'price' => 95000,
                'description' => "A wonderful crust layered with herbed tomato sauce and toppings will encourage you to dig right in to this low-fat pizza",
                'image' => 'wholewheatveggie.jpg'
            ],
        ]);
    }
}
