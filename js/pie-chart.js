poll_chart();
function poll_chart() {
  const $chart = document.querySelectorAll('#chart')
  $chart.forEach(chart => {
    console.log(chart)
    const ctx = chart.getContext('2d');

    const effective = chart.dataset.effective;
    const noeffective = chart.dataset.noeffective;
  
    let data;
  
    if(effective == 0 && noeffective == 0) {
      data = {
        labels: ['まだ投票がありません。'],
        datasets: [{
          data: [1],
          backgroundColor: [
            '#9ca3af'
          ],
          borderColor: [
            '#3b3938'
          ]
        }]
      }
    } else {
      data = {
        labels: ['効果あり', '効果なし'],
        datasets: [{
          data: [effective, noeffective],
          backgroundColor: [
            '#f1c846',
            '#4a8255'
          ],
          borderColor: [
            '#3b3938',
            '#3b3938'
          ]
        }]
      }
    }
  
    new Chart(ctx,  {
      type: 'pie',
      data: data,
      options: {
        legend: {
          position: 'bottom',
          labels: {
            fontSize: 12
          }
        }
      }
    });
  });
}