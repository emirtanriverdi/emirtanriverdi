// We create an array to store previously visited URLs.
let visitedURLs = [];

// Function that returns a random number in a given range.
function getRandomNumber(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

// Function that generates a URL by choosing a random number.
function generateRandomImageURL() {
  const baseURL = "https://cdn.emirtanriverdi.rf.gd/r/";
  const randomNumber = getRandomNumber(1, 500);
  const imageURL = `${baseURL}${randomNumber}.jpg`;

// If this URL has not been visited before, we add it to the array and return the URL.
  if (!visitedURLs.includes(imageURL)) {
    visitedURLs.push(imageURL);
    return imageURL;
  } else {
// If this URL has already been visited, we generate a random URL again.
    return generateRandomImageURL();
  }
}

// Generate a random image URL and display the image
function displayRandomImage() {
  const randomImageURL = generateRandomImageURL();
  const image = new Image();
  image.src = randomImageURL;
  document.body.appendChild(image);
}

displayRandomImage();