<template>
  <canvas id="trafficChart"></canvas>
</template>
<script>
import Chart from "chart.js/auto";
export default {
  name: "TrafficChart",
  props: {
    labels: Array,
    values: Array,
  },

  data() {
    return {
      chartData: {
        type: "doughnut",
        data: {
          labels: [],
          datasets: [
            {
              label: "Traffic Chart",
              data: [],
              backgroundColor: [
                "rgb(255, 99, 132)",
                "rgb(54, 162, 235)",
                "rgb(255, 205, 86)",
              ],
              hoverOffset: 4,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
          maintainAspectRatio: false,
          responsive: true,
          animation: false,
        },
      },
    };
  },
  components: {
    Chart,
  },

  mounted() {
    this.chartData.data.labels = this.labels;
    this.chartData.data.datasets[0].data = this.values;
    const trafficChart = "trafficChart";
    new Chart(trafficChart, this.chartData);
  },
};
</script>
