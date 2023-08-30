
<script type="text/javascript" src="vue.global.js"></script>
<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.22.1/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.22.1/firebase-analytics.js";
  import { getDatabase, ref, set, onValue, push } from "https://www.gstatic.com/firebasejs/9.22.1/firebase-database.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyCRRLWsHGu6OagzJ4P6DlYGluwyOfGkwZk",
    authDomain: "gennakar-8bc8b.firebaseapp.com",
    projectId: "gennakar-8bc8b",
    storageBucket: "gennakar-8bc8b.appspot.com",
    messagingSenderId: "175197220117",
    appId: "1:175197220117:web:524e4f200d0620052e8d1c",
    measurementId: "G-TMJ68LYXY8",
    databaseURL: 'https://gennakar-8bc8b-default-rtdb.asia-southeast1.firebasedatabase.app'
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
  var database = getDatabase(app);


const { reactive, createApp, onMounted, nextTick, computed } = Vue;
const chat = createApp({
  setup() {
    const vueRef = Vue.ref
    const messages = vueRef([]);
    const text = vueRef('');

    const addData = () => {
      var data = {
        name: text.value,
      };

      push(ref(database, "users"), data)
      .then(() => {
        console.log("Data successfully written to the database!");
        text.value = '';
      })
      .catch((error) => {
        console.error("Error writing data to the database:", error);
      });
      // set(ref(database, "users/" + index.value), data)
      //   .then(() => {
      //     console.log("Data successfully written to the database!");
      //   })
      //   .catch((error) => {
      //     console.error("Error writing data to the database:", error);
      //   });
    }

    const watchData = () => {
      onValue(ref(database, "users"), function(snapshot) {
        messages.value = snapshot.val() || [];
      });
    }

    onMounted(() => {
      watchData();
    });

    return {
      messages,
      addData,
      text
    }
  }
});

chat.mount('#chat-module');


</script>

<style type="text/css">
  [v-cloak] {
    display: none;
  }
</style>

<div id="chat-module" v-cloak>
  
  
    <div v-for="m in messages" style="background: #eae; padding: 10px; margin-bottom: 5px">
      {{m.name}}
    </div>

    <div>
      <input type="" name="" v-model="text">
      <button @click="addData()">
    send
  </button>
    </div>

</div>
