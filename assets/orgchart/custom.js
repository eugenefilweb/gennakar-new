const initOrgChart = ({xml, template, subscribe}) => {
    const exportUrl = parseInt(subscribe) == 1 ? 'https://balkan.app/export': (app.baseUrl + 'organizational-chart/export');

    const menu = parseInt(subscribe) == 1 ? {
            save: {
                text: "Save",
                icon: OrgChart.icon.details(24, 24, '#7A7A7A'),
                onClick: function() {
                    save(chart, true);
                }
            },
            pdfPreview: {
                text: "PDF Preview",
                icon: OrgChart.icon.pdf(24, 24, '#7A7A7A'),
                onClick: function() {
                    OrgChart.pdfPrevUI.show(chart, {
                        format: 'A4',
                        margin:[
                            100, 40, 50, 40
                        ],
                        header: '<h1 style="text-align: center">Organizational Chart</h1>'
                    });
                }
            },
            pdf: { text: "Export PDF" },
            png: { text: "Export PNG" },
            svg: { text: "Export SVG" },
            csv: { text: "Export CSV" },
        }: {
            save: {
                text: "Save",
                icon: OrgChart.icon.details(24, 24, '#7A7A7A'),
                onClick: function() {
                    save(chart, true);
                }
            },
            pdf: { text: "Export PDF" },
        }

    const save = (chart, withMessage=false) => {
        try {
            if (withMessage) {
                KTApp.blockPage({
                    overlayColor: '#000',
                    message: 'Saving...',
                    state: 'primary'
                });
            }

            $.ajax({
                url: app.baseUrl + 'organizational-chart/save',
                data: {
                    organizational_chart: chart.getXML(),
                    organizational_chart_template: document.getElementById("select-template").value
                },
                dataType: 'json',
                method: 'post',
                success: (s => {
                    if (withMessage) {
                        if (s.status == 'success') {
                            Swal.fire('Success', s.message, 'success');
                        }
                        else {
                            Swal.fire('Error', s.message, 'error');
                        }
                        KTApp.unblockPage();
                    }
                }),
                error: (e => {
                    if (withMessage) {
                        KTApp.unblockPage();
                    }
                    console.log('error', e);
                })
            })
        }
        catch(e) {
            alert("There is a custom field that has `space` or invalid name like numbers (eg: 123)\nThis page will reload.");
            window.location.reload();
        }
    }
    const chart = new OrgChart(document.getElementById("tree"), {
        template: template,
        layout: OrgChart.tree,
        mouseScrool: OrgChart.none,
        align: OrgChart.ORIENTATION,
        exportUrl,
        toolbar: {
            layout: true,
            zoom: true,
            fit: true,
            expandAll: true
        },
        nodeBinding: {
            field_0: "Name",
            field_1: "Title",
            field_2: "Contact",
            img_0: "img",
        },
        enableDragDrop: true,
        nodeMenu: {
            details: { text: "Details" },
            edit: { text: "Edit" },
            add: { text: "Add" },
            remove: { text: "Remove" }
        },
        menu,
    });


    chart.on('init', function (sender) {
    //     sender.editUI.show(1);
        // sender.toolbarUI.showLayout();

    });

    chart.onRedraw(() => {

            save(chart);

        // console.log('onRedraw', chart.getXML())
    });
    // chart.load([
    //     { id: 1, Name: "Denny Curtis", Title: "CEO", img: "https://cdn.balkan.app/shared/2.jpg", Contact: '09123123' },
    //     { id: 2, pid: 1, Name: "Ashley Barnett", Title: "Sales Manager", img: "https://cdn.balkan.app/shared/3.jpg" },
    //     { id: 3, pid: 1, Name: "Caden Ellison", Title: "Dev Manager", img: "https://cdn.balkan.app/shared/4.jpg" },
    //     { id: 4, pid: 2, Name: "Elliot Patel", Title: "Sales", img: "https://cdn.balkan.app/shared/5.jpg" },
    //     { id: 5, pid: 2, Name: "Lynn Hussain", Title: "Sales", img: "https://cdn.balkan.app/shared/6.jpg" },
    //     { id: 6, pid: 3, Name: "Tanner May", Title: "Developer", img: "https://cdn.balkan.app/shared/7.jpg" },
    //     { id: 7, pid: 3, Name: "Fran Parsons", Title: "Developer", img: "https://cdn.balkan.app/shared/8.jpg" }
    // ]);
    chart.loadXML(xml);
    // '<?xml version="1.0" encoding="utf-8" ?><nodes><node id="1" Name="Roel" Title="CEO" img="https://cdn.balkan.app/shared/2.jpg" Contact="09123123"/><node id="2" pid="1" Name="Ashley Barnett" Title="Sales Manager" img="https://cdn.balkan.app/shared/3.jpg"/><node id="3" pid="1" Name="Caden Ellison" Title="Dev Manager" img="https://cdn.balkan.app/shared/4.jpg"/><node id="4" pid="2" Name="Elliot Patel" Title="Sales" img="https://cdn.balkan.app/shared/5.jpg"/><node id="5" pid="2" Name="Lynn Hussain" Title="Sales" img="https://cdn.balkan.app/shared/6.jpg"/><node id="6" pid="3" Name="Tanner May" Title="Developer" img="https://cdn.balkan.app/shared/7.jpg"/><node id="7" pid="3" Name="Fran Parsons" Title="Developer" img="https://cdn.balkan.app/shared/8.jpg"/><node id="_3pef" pid="1"/></nodes>'

    document.getElementById("select-template").addEventListener("change", function () {
        chart.config.template = this.value;
        chart.draw();
    });
}