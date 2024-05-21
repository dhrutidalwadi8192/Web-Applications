// Animal constructor
function Animal(name, species, phrase) {
  this.name = name;
  this.species = species;
  this.phrase = phrase;
}

// sound prototype method
Animal.prototype.sound = function () {
  return `${this.name} the ${this.species} says: ${this.phrase}`;
};

// message prototype method
Animal.prototype.say = function (message) {
  return `${this.name} the ${this.species} says: ${message}`;
};

// run the program
let duck = new Animal("Donald", "Duck", "Aw, Phooey!");

let rabbit = new Animal("Buggs", "Bunny", "What's up Doc?!");

let human = new Animal("John", "Human", "Oh boy, Pizza! Yum!");

// display output
console.log(duck.sound());
console.log(rabbit.sound());
console.log(human.sound());
console.log(duck.say("Coding is fun!"));
console.log(rabbit.say("Coding is fun!"));
console.log(human.say("Coding is fun!"));
