function getChartColorsArray(e) {
    if (null !== document.getElementById(e)) {
        var t = document.getElementById(e).getAttribute("data-colors");
        if (t) return (t = JSON.parse(t)).map(function(e) {
            var t = e.replace(" ", "");
            return -1 === t.indexOf(",") ? getComputedStyle(document.documentElement).getPropertyValue(t) || t : 2 == (e = e.split(",")).length ? "rgba(" + getComputedStyle(document.documentElement).getPropertyValue(e[0]) + "," + e[1] + ")" : t
        });
        console.warn("data-colors Attribute not found on:", e)
    }
}
var isApexSeries = document.querySelectorAll("[data-chart-series]"),
    donutchartProjectsStatusColors = (isApexSeries && Array.from(isApexSeries).forEach(function(e) {
        var t, e = e.attributes;
        e["data-chart-series"] && (isApexSeriesData.series = e["data-chart-series"].value.toString(), t = getChartColorsArray(e.id.value.toString()), t = {
            series: [isApexSeriesData.series],
            chart: {
                type: "radialBar",
                width: 36,
                height: 36,
                sparkline: {
                    enabled: !0
                }
            },
            dataLabels: {
                enabled: !1
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 0,
                        size: "50%"
                    },
                    track: {
                        margin: 1
                    },
                    dataLabels: {
                        show: !1
                    }
                }
            },
            colors: t
        }, new ApexCharts(document.querySelector("#" + e.id.value.toString()), t).render())
    }), getChartColorsArray("prjects-status")),
    currentChatId = (donutchartProjectsStatusColors && (options = {
        series: [125, 42, 58, 89],
        labels: ["Completed", "In Progress", "Yet to Start", "Cancelled"],
        chart: {
            type: "donut",
            height: 230
        },
        plotOptions: {
            pie: {
                size: 100,
                offsetX: 0,
                offsetY: 0,
                donut: {
                    size: "90%",
                    labels: {
                        show: !1
                    }
                }
            }
        },
        dataLabels: {
            enabled: !1
        },
        legend: {
            show: !1
        },
        stroke: {
            lineCap: "round",
            width: 0
        },
        colors: donutchartProjectsStatusColors
    }, (chart = new ApexCharts(document.querySelector("#prjects-status"), options)).render()), "users-chat");

function scrollToBottom(r) {
    setTimeout(function() {
        var e = document.getElementById(r).querySelector("#chat-conversation .simplebar-content-wrapper") ? document.getElementById(r).querySelector("#chat-conversation .simplebar-content-wrapper") : "",
            t = document.getElementsByClassName("chat-conversation-list")[0] ? document.getElementById(r).getElementsByClassName("chat-conversation-list")[0].scrollHeight - window.innerHeight + 850 : 0;
        t && e.scrollTo({
            top: t,
            behavior: "smooth"
        })
    }, 100)
}
scrollToBottom(currentChatId);