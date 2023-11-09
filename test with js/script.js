const client = filestack.init('AwxQNt5QZCr9LcJtnxGBQz');

const image = document.getElementById('imageElement');
const fileInput = document.getElementById('fileInput');
const imageUrlInput = document.getElementById('image-url');
let imageUrl;

fileInput.addEventListener("change", (e) => {
    const file = e.target.files[0];

    client.upload(file).then((response) => {
        imageUrl = response.url;
        console.log("URL завантаженого файлу:", imageUrl);
        
        // Зберігаємо URL у прихованому input
        imageUrlInput.value = imageUrl;
        console.log("Значення поля image_url: " + imageUrlInput.value);
    }).catch((error) => {
        console.log(error);
    });
});

const showImg = document.querySelector('#showImg');
const urlParagraph = document.querySelector('#urlParagraph');

showImg.addEventListener('click', function() {
    image.src = imageUrl;
    urlParagraph.textContent = imageUrl;
});

// Initializing Filestack with API key
// const client = filestack.init('AwxQNt5QZCr9LcJtnxGBQz');

// const image = document.getElementById('imageElement');
// const fileInput = document.getElementById('fileInput');
// const imageUrlInput = document.getElementById('image-url');

// if (fileInput) {
//     // Attaching an image upload event
//     fileInput.addEventListener('change', () => {
//         // Image uploading via Filestack
//         client.picker({
//             accept: 'image/*',
//             onUploadDone: (file) => {
//                 // Get URL of uploaded image
//                 const imageUrl = file.url;

//                 // Set URL as "image_url" field value
//                 document.getElementById('image-url').value = imageUrl;
//                 console.log('URL завантаженого зображення:', imageUrl);
//             }
//         }).open();
//     });
// } else {
//     console.log('Error');
// }

// const client = filestack.init('AwxQNt5QZCr9LcJtnxGBQz');

// document.addEventListener('DOMContentLoaded', function () {
//     const imageInput = document.getElementById('image-url');
//     const openPickerButton = document.getElementById('fileInput');

//     openPickerButton.addEventListener('click', () => {
//         client.picker({
//             // uploadInBackground: true,
//             fromSources: ['local_file_system', 'url', 'imagesearch'],
//             accept: 'image/*',
//             crop: false,
//             maxSize: 1024 * 1024 * 10,
//             onUploadDone: (file) => {
//                 const imageUrl = file.url;
//                 imageInput.value = imageUrl;
//                 console.log('URL завантаженого зображення:', imageUrl);
//             }
//         }).open();
//     });
// });





// const apikey = 'AwxQNt5QZCr9LcJtnxGBQz';
// const client = filestack.init(apikey);

// var options ={
// 	"accept": [
// 		"image/*"
// 	],
// 	"fromSources": [
// 		"local_file_system",
// 		"url",
// 		"local_file_system"
// 	],
// 	"maxSize": 10
// };

// const picker = client.picker(options);
// picker.open();