
var y = $var;

var x = $var;

let graph1=document.getElementById("graph1").getContext("2d");
var char = new Chart(graph1,{
  type: 'bar',
    data: {
        labels: ['Convenio Marco', 'Convenio Específico', 'Convenio Internacional'],
        datasets: [{
            label: 'Clasificación de Convenios Insitucionales',
            data: [x, y, x],
            backgroundColor: [
                'rgba(13,25,191,0.2)',
                
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(13,25,191,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
               
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }, 
        },
        plugins: {
     datalabels: {
     }
   }
    },
    plugins:[ChartDataLabels]
});


