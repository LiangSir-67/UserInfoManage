$(window).resize(function () {
    window.location.reload();
});
$(document).ready(function () {
    get1();
    get2();
    get3();
});


function get1() {
    $.get('http://127.0.0.1:8000/api/test', function (data) {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main1'));
        var ledata = ['ACM', '人工智能', '物联网', 'KOOV','信息安全'];
        var xdata = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00'];
        var serdata = [
            {
                name: 'ACM',
                type: 'line',
                data: [0,0,0,0,1,1]
            },
            {
                name: '人工智能',
                type: 'line',
                data: [0,0,0,0,1,2]
            },
            {
                name: '物联网',
                type: 'line',
                data: [0,0,0,0,2,2]
            },
            {
                name: 'KOOV',
                type: 'line',
                data: [0,0,0,0,1,3]
            },
            {
                name: '信息安全',
                type: 'line',
                data: [0,0,0,0,2,3]
            }];
        console.log(serdata)
        console.log(xdata)
        console.log("============覆盖前后============")
        for (i = 0; i < data.data.length - 1; i++) {
            ledata[i] = data.data[i]['lab_name'];
            serdata[i].data[0] = data.data[i].data[0];
            serdata[i].data[1] = data.data[i].data[1];
            serdata[i].data[2] = data.data[i].data[2];
            serdata[i].data[3] = data.data[i].data[3];
            serdata[i].data[4] = data.data[i].data[4];
            serdata[i].data[5] = data.data[i].data[5];

            serdata[i] = {
                name: data.data[i]['lab_name'],
                type: 'line',
                // data: data.data[i].data
                data: serdata[i].data
            }
        }
        xdata[0] = data.data[data.data.length - 1][0];
        xdata[1] = data.data[data.data.length - 1][1];
        xdata[2] = data.data[data.data.length - 1][2];
        xdata[3] = data.data[data.data.length - 1][3];
        xdata[4] = data.data[data.data.length - 1][4];
        xdata[5] = data.data[data.data.length - 1][5];
        console.log(serdata)
        console.log(xdata)
        option = {
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ledata
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '10%',
                containLabel: true
            },
            xAxis: {
                type: 'category',
                boundaryGap: true,
                data: xdata
            },
            yAxis: {
                type: 'value'
            },
            series: serdata
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    });
}

function get2() {
    $.get('http://127.0.0.1:8000/api/data/inoutd', function (data) {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main2'));
        ledata = ['人工智能', 'ACM', '移动MM', 'KOOV'];
        serdata1 = [{
            value: 700,
            selected: true
        },
            {
                value: 335,
                selected: true
            },
            {
                value: 679,
                selected: true
            },
            {
                value: 548,
                selected: true
            }];

        serdata = [{
            value: 700,
            name: 'KOOV',
            selected: true
        },
            {
                value: 335,
                name: '人工智能',
                selected: true
            },
            {
                value: 679,
                name: 'ACM',
                selected: true
            },
            {
                value: 548,
                name: '移动MM',
                selected: true
            }];

        console.log(data.data)
        for (i = 0; i < data.data.length; i++) {
            console.log(data.data[i].labname);
            ledata[i] = data.data[i].labname;
            serdata1[i] = {
                value: data.data[i].number,
                selected: true
            };
            serdata[i] = {
                value: data.data[i].number,
                name: data.data[i].labname,
                selected: true
            };
        }

        console.log(ledata)
        console.log(serdata)
        option = {
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b}: {c} ({d}%)'
            },
            legend: {
                orient: 'vertical',
                left: 10,
                data: ledata
            },
            series: [{
                name: '访问人数',
                type: 'pie',
                selectedMode: 'single',
                radius: [0, '30%'],

                label: {
                    position: 'inner'
                },
                labelLine: {
                    show: false
                },
                data: serdata1
            },
                {
                    name: '进入人数',
                    type: 'pie',
                    radius: ['40%', '55%'],
                    label: {
                        formatter: '{a|{a}}{abg|}\n{hr|}\n  {b|{b}：}{c}  {per|{d}%}  ',
                        backgroundColor: '#eee',
                        borderColor: '#aaa',
                        borderWidth: 1,
                        borderRadius: 4,
                        rich: {
                            a: {
                                color: '#999',
                                lineHeight: 22,
                                align: 'center'
                            },
                            hr: {
                                borderColor: '#aaa',
                                width: '100%',
                                borderWidth: 0.5,
                                height: 0
                            },
                            b: {
                                fontSize: 16,
                                lineHeight: 33
                            },
                            per: {
                                color: '#eee',
                                backgroundColor: '#334455',
                                padding: [2, 4],
                                borderRadius: 2
                            }
                        }
                    },
                    data: serdata
                }
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    });
}


function get3() {
    $.get('http://127.0.0.1:8000/api/data/inoutm',function (data) {
        var myChart = echarts.init(document.getElementById('main3'));

        dimenData = ['lab', 'week', 'month', 'term'];
        sourceData = [
            {lab: '人工智能', 'week': 99, 'month': 235, 'term': 599},
            {lab: 'ACM', 'week': 83, 'month': 173, 'term': 555},
            {lab: '移动MM', 'week': 86, 'month': 165, 'term': 582},
            {lab: '物联网', 'week': 72, 'month': 153, 'term': 639},
            {lab: '信息安全', 'week': 52, 'month': 153, 'term': 589},
            {lab: '大数据', 'week': 52, 'month': 153, 'term': 589},
        ];

        for (i = 0;i < data.data.length;i++){
            console.log(data.data[i].labname)
            sourceData[i].lab = data.data[i].labname;
            sourceData[i].week = data.data[i].week_number;
            sourceData[i].month = data.data[i].mon_number;
            sourceData[i].term = data.data[i].term_number;
        }

        option = {
            legend: {},
            tooltip: {},
            dataset: {
                dimensions: dimenData,
                source: sourceData
            },
            xAxis: {type: 'category'},
            yAxis: {},

            series: [
                {type: 'bar'},
                {type: 'bar'},
                {type: 'bar'}
            ]
        };
        myChart.setOption(option);
    });
}
