$(document).ready(function(){
  $.post("",{action:""},
    function (data, textStatus, jqXHR) {
      console.log(data)
      let json_data = JSON.parse(data);

      console.log(json_data)
      new Chart(document.getElementById('bloodTypeChart'), {
    type: 'pie',
    data: {
      labels: ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'],
      datasets: [{
        data: json_data.blood_supply,
        backgroundColor: ['#007bff', '#17c671', '#fd7e14', '#ffc107', '#6f42c1', '#20c997', '#f59f00', '#ffa94d']
      }]
    }
  });

  let monthlyDonationsChart = new Chart(document.getElementById('monthlyDonationsChart'), {
    type: 'bar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      datasets: [{
        label: 'Donations',
        data: json_data.requests,
        backgroundColor: '#ff3d3d'
      }]
    },
    options: {
    scales: {
      x: {
        ticks: {
          font: {
            size: 14,
            weight: 'bold',
          },
          color: '#333', 
        },
        grid: {
          display: false, 
        },
      },
      y: {
        ticks: {
          font: {
            size: 14,
            weight: 'bold',
          },
          color: '#333',
          beginAtZero: true,
        },
        grid: {
          color: '#eee',
        },
      },
    },
    plugins: {
      legend: {
        labels: {
          font: {
            size: 16,
            weight: 'bold',
          },
          color: '#000',
        },
      },
      tooltip: {
        bodyFont: {
          size: 14,
        },
      },
    },
    responsive: true,
    maintainAspectRatio: false,
  },
  });
  $("select").on("change",function(){
    let year = $(this).val();
    $.post("",{action:"new_date",year:year},function(data){
        console.log(data)
        let json_data = JSON.parse(data)
        console.log(json_data)
      monthlyDonationsChart.data.datasets[0].data = json_data.request;
      monthlyDonationsChart.update();
    })
  })
    },
  );
  
  
})