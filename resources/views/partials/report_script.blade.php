<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.39/vfs_fonts.js"></script>
<script type="text/javascript">
        function Export(metaData, reportName, data, takenBy, serverDate) {
            /*html2canvas(document.getElementById('afcsReportTable'), {
                onrendered: function (canvas) {*/
                    var docDefinition = {
                        watermark: {text: 'Opiant Tech Solutions Pvt. Ltd.', color: '#367fa9', opacity: 0.1, bold: true, italics: false},
                        pageSize: 'A4',
                        pageOrientation: 'landscape',
                        pageMargins: [ 20, 100, 40, 20 ],
                        header: {
                            columns: [
                                {
                                    stack: [
                                        {
                                            columns: [{ image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAE4AAABZCAYAAACQeRI+AAAACXBIWXMAAAsTAAALEwEAmpwYAAAFHGlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDIgNzkuMTYwOTI0LCAyMDE3LzA3LzEzLTAxOjA2OjM5ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ0MgMjAxOCAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDE4LTA5LTI3VDE4OjA5OjM3KzA1OjMwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAxOC0wOS0yN1QxODoxMDowOCswNTozMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAxOC0wOS0yN1QxODoxMDowOCswNTozMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo4Zjg0OTdmZC0wZDI3LTc1NGMtOGM3Zi1iMjY0NjBlNzkyZmEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OGY4NDk3ZmQtMGQyNy03NTRjLThjN2YtYjI2NDYwZTc5MmZhIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6OGY4NDk3ZmQtMGQyNy03NTRjLThjN2YtYjI2NDYwZTc5MmZhIj4gPHhtcE1NOkhpc3Rvcnk+IDxyZGY6U2VxPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iY3JlYXRlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo4Zjg0OTdmZC0wZDI3LTc1NGMtOGM3Zi1iMjY0NjBlNzkyZmEiIHN0RXZ0OndoZW49IjIwMTgtMDktMjdUMTg6MDk6MzcrMDU6MzAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCBDQyAyMDE4IChXaW5kb3dzKSIvPiA8L3JkZjpTZXE+IDwveG1wTU06SGlzdG9yeT4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6lUZKQAAADmklEQVR4nO2dzWvTYBzHP0nTvXRjIqI3RZzeBJUKOtT5ehcRDyoyQS/iwZNe/QO8iIfhRRFf8CB42HXg0NvOOpEhbCJzKOI2px1bu8ZDkrlhXdpfkj5p+/tAWF/y5PnyIX3yS9I9tVzXRakdByCfz98CzgEW8MtoovRiA93AODDq+C/uA/Ybi9RY7ARKtv9k3mSSBmMOKATiyiaTNBglYNkOXU2piIoTouKEBOLajaZoQIJy5DdQ9B8vG8piEgtY8v92V9MgEHcPeLlqA62GjbfzbAKeAJvDGgTixv2l1cnh1bSh4vTgsJYeIFPNit4eV5hLMkxEXGjrAidrOsgaHIBM/4DpHP8n20F57BXutwmgDG05yDhg+KqOA2D3HjAaYl3sDNaWHbhT7z2BSwtQXATb7CjjALiFWaMh1sV1IduOtW0PmV19LA8P4n5+C509RmM54asYxrKg5FdImaz/EbWS6u0HVV7wCMRdBk7hJVpIJlPNdOJdibgDvPNeqjiu7Qa287eAlZABvuPVcRuqaRCIOw5cFHaaNC9YEVeRG8DVOmVZIRhh07KXVaIU8n4x5P1EaIYC2Ehd0gzijKDihKg4ISqudizAUnG1kwPa0n/mEJ1p4CZeydURcVsOMAtMt4K4WeBZ3BtthY+qTfQ97R+ke9wI8BjYWGO7GWAAOCbsV0rsVwWk4uaBR8K2Z4TtUoX0oxrlPmxT3MNthTEuEVScEBUnRMUJUXFCVJwQFSdExQlRcUJUnBAVJ0TFCVFxQlScEBUnRMUJUXFCVJwQFSdExQlRcUJUnBAVJ0TFCVFxQlScEBUnRMUJUXFCVJwQqbgoEx40xWQJ0i8W5oDzyL6R2SXsM1VIxZ30l5ZFxzghKk6IihOi4oSoOCEqToiKE9II4lI5n10jiOs0HaASgbhUhvPZajpAJYJTrjd48iygQDz/bVcEeoE+oC3CdgoxZImdQNwDf0mCo8BdYK+w/ZfYksRIPca418BBYFDYPrEZqKJQr4PDInAdOAGM1anPRKn3UXUEOAQ8rHO/sWOiHJkDrgCngY8G+o8Fk3XcEHAYeGowgxjTBfBX4BJwAZgynKUmTIsLeA4cwZv9uiFIiziACeAscI21v5uTyl8jSpO4gPtAHhj1n4fNWRl2VpIjRfOOJM040A/cBj6FrDsD/MSbHHT1dNtlvJnyJ0ngCktaxYF343qI8IPGB2AY70CzWpyLN3f5JAmI+wPLpoofPiyxUAAAAABJRU5ErkJggg==',
                                            width: 25,
                                            margin: [90, 10, 0, 0],
                                            alignment: 'center'
                                            },
                                            {
                                                text: "Opiant Tech Solutions Pvt. Ltd.",
                                                style: 'topHeader'
                                            }]
                                        },
                                        {
                                            text: reportName,
                                            style: 'middleHeader'
                                        },
                                        {
                                            columns: metaData,
                                            style: 'metaStyle'
                                        }
                                    ],
                                    width: '*'
                                }
                            ],
                            margin: [20, 0, 30, 0]
                        },
                        footer: function(currentPage, pageCount)
                        {
                            return {
                                columns: [
                                    { text: 'Print taken By : '+ takenBy, alignment: 'left' },
                                    { text: 'Page '+currentPage+' of '+pageCount, alignment: 'center' },
                                    { text: serverDate, alignment: 'right' }
                                ],
                                margin: [20, 0, 30, 0]
                            }
                        },
                        content: [
                        {
                            style: 'tableStyle',
                            table:{
                                headerRows: 1,
                                widths: '*',
                                body: data
                            },
                            layout: 'lightHorizontalLines'
                        }],
                        styles: {
                            topHeader: {
                                fontSize: 16,
                                bold: true,
                                alignment: 'center',
                                marginTop: 10, 
                                color: '#000'
                            },
                            middleHeader: {
                                fontSize: 12,
                                alignment: 'center',
                                marginBottom: 10,
                                bold: true, 
                                color: '#000'
                            },
                            metaStyle: {
                                fontSize: 12,
                                bold: true,
                                color: '#000'
                            },
                            tableStyle: {
                                fontSize: 8,
                                color: '#333'
                            },
                            tableHeader: {
                                bold: true

                            },
                            tableHeaderStyle: {
                                fillColor: '#eee',
                                color: '#333',
                                bold: true
                            }
                        }
                    };
                    pdfMake.createPdf(docDefinition).download(reportName+'.pdf');
                /*}
            });*/
        }
$(document).ready(function(){
        $(document).on('change', '#depot_id', function(){
        clearReportData();
        });

        $(document).on('change', '#from_date', function(){
            clearReportData();
        });

        $(document).on('change', '#to_date', function(){
            clearReportData();
        });

        $(document).on('change', '#date', function(){
            clearReportData();
        });

        $(document).on('change', '#report_date', function(){
            clearReportData();
        });

        $(document).on('change', '#shift_date', function(){
            clearReportData();
        });

        $(document).on('change', '#status_type', function(){
            clearReportData();
        });

        $(document).on('change', '#etm_no', function(){
            clearReportData();
        });
});
function clearReportData()
        {
            $('#reportDataBox').remove();
        }
</script>