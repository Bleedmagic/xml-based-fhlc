document.addEventListener('DOMContentLoaded', function () {
  const ctx = document.getElementById('gradesAndRemarks');

  if (
    Array.isArray(gradesRemarksData) &&
    gradesRemarksData.length === 2 &&
    (gradesRemarksData[0] > 0 || gradesRemarksData[1] > 0)
  ) {
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Failed', 'Passed'],
        datasets: [
          {
            data: gradesRemarksData,
            backgroundColor: ['#4e73df', '#1cc88a'],
            hoverBackgroundColor: ['#2e59d9', '#17a673'],
            hoverBorderColor: 'rgba(234, 236, 244, 1)',
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: 'rgb(255,255,255)',
          bodyFontColor: '#858796',
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false,
        },
        cutoutPercentage: 60,
      },
    });
  } else {
    ctx.parentElement.innerHTML = `<p class="text-muted text-center mb-0">No grade data available.</p>`;
  }
});
