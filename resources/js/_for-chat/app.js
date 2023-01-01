import { data } from "jquery";

const chatBody = document.querySelector(".chat-body");
const txtInput = document.querySelector("#txtInput");
const send = document.querySelector(".send");

send.addEventListener("click", () => renderUserMessage());

txtInput.addEventListener("keyup", (event) => {
  if (event.keyCode === 13) {
    renderUserMessage();
  }
});

const renderUserMessage = () => {
  const userInput = txtInput.value;
  renderMessageEle(userInput, "user");
  txtInput.value = "";

// $.get('send' , function(userInput){
//     console.log(userInput);
// })

$.ajaxSetup({
    headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
//var newdata = "userinput:" + userInput;
$.ajax({
    type: "POST",
    url: "send",
    data: {newdata : userInput},
    success: function(data){
        renderMessageEle(data , "chatbot");

        console.log(data);

    }

});

  setTimeout(() => {
    setScrollPosition();
  }, 600);
};



// const renderChatbotResponse = (userInput) => {
//   const res = getChatbotResponse(userInput);
//   renderMessageEle(res);
// };

const renderMessageEle = (txt, type) => {
  let className = "user-message";
  if (type !== "user") {
    className = "chatbot-message";
  }
  const messageEle = document.createElement("div");
  const txtNode = document.createTextNode(txt);
  messageEle.classList.add(className);
  messageEle.append(txtNode);
  chatBody.append(messageEle);
};

// const getChatbotResponse = (userInput) => {
//   return responseObj[userInput] == undefined
//     ? "Please try something else"
//     : responseObj[userInput];
// };

const setScrollPosition = () => {
  if (chatBody.scrollHeight > 0) {
    chatBody.scrollTop = chatBody.scrollHeight;
  }
};
// here the Response function
//  const responseObj = {
//    hello: "Hey ! How are you doing ?",
//    hey: "Hey! What's Up",
//    today: new Date().toDateString(),
//    time: new Date().toLocaleTimeString(),
//  };

