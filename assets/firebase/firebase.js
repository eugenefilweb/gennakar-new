// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.22.1/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.22.1/firebase-analytics.js";
import { getDatabase, ref, set, get, onValue, push, limitToFirst, orderByChild, query, onChildAdded, onChildChanged } from "https://www.gstatic.com/firebasejs/9.22.1/firebase-database.js";
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
const firebaseApp = initializeApp(firebaseConfig);
const analytics = getAnalytics(firebaseApp);
var database = getDatabase(firebaseApp);

const alertLevelRef = ref(database, "alert-level");

onValue(alertLevelRef, function(snapshot) {
  const btn = $('.alert-level .btn-alert-level');
  if(snapshot) {
    const alertLevel = snapshot.val();

    if(alertLevel) {
      btn.removeClass('btn-danger')
        .removeClass('btn-primary')
        .removeClass('btn-outline-secondary');

      btn.addClass('btn-' + alertLevel.class);
      btn.html(alertLevel.label);
    }
  }
});


$('.alert-level .dropdown-item').click(function() {
  KTApp.block('.alert-level', {
    overlayColor: '#000',
    message: 'Changing alert level',
    state: 'primary'
  });

  const alertId = $(this).data('id');
  const alertLabel = $(this).data('label');
  const alertClass = $(this).data('class');
  const alertDescription = $(this).data('description');

  $.ajax({
    url: app.baseUrl + 'setting/change-alert-level',
    data: { alert_level: alertId },
    method: 'get',
    dataType: 'json',
    success: (s) => {
      set(alertLevelRef, {
        id: alertId, 
        label: alertLabel, 
        class: alertClass,
        description: alertDescription
      })
      .then((result) => {
        swal.fire('Alert Level: ' + alertLabel, alertDescription, 'success');
        KTApp.unblock('.alert-level');
      })
      .catch((error) => {
        KTApp.unblock('.alert-level');
        console.error("Error setting data:", error);
      });
    },
    error: (e) => {
      swal.fire('Error', e.responseText, 'danger');
      KTApp.unblock('.alert-level');
    }
  });
});