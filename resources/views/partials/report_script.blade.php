<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.39/vfs_fonts.js"></script>
<script type="text/javascript">
    var mainLogoBase64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAE4AAABZCAYAAACQeRI+AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MTdCQkU3MzcxRTBCMTFFOTkxREI4QzE1MjFGNjM5RUIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MTdCQkU3MzgxRTBCMTFFOTkxREI4QzE1MjFGNjM5RUIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDoxN0JCRTczNTFFMEIxMUU5OTFEQjhDMTUyMUY2MzlFQiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDoxN0JCRTczNjFFMEIxMUU5OTFEQjhDMTUyMUY2MzlFQiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PrlpxMkAAAJfSURBVHja7Ny/axNhHMfxe+6SNJcYUkFQk0MDkkiri1YculjFtosdHETBUv8BR0GXUulU6O7uj1JKoaJbq7Y4OZlNkHSxcNGlQ2tMor3cnTmhIg6SexLlwXt/hiQEnrt7Xvk+T56HhBO+72skfMQvcAiGcNuHA00SDjzggAMOOAIccArAkc4LCDjggAMOOOCAA04JuHPTi88PDpyfCN5x95pKXL2RMDXfc7W0VRLPRtSDiwWP/SeHJlK5E0p+/Pbao3vayNRcDzrb0+g/quxbU+GRI5S8OJ0pDTjggAOOANejxCLST0HFMVQjOFTb+9nGl63383o8cTxMO8/Z28oUBu/q8b5kJOF8x2lmi2fuy7Rt1T/f/h/gpIaqMAzpL5Vu2jLHAQccAQ444IAjwAEHHHDAEeCAAw444AhwwAEHHAEOOOCAA44ABxxwwAHXUXzPbcmesJu2KkXqv2oiFjd3K2/vCCNuhUJzHftAYdCMLJyRMFPZ0tA8Q5UABxxwwBHggAPuD2kAJ7dHs5SFM/rU3QUZyfQVZbdcO5Xymp4wx4LXXo/udOO1HC11pBB0vNvjVJWFy1+6Mf63TlDdWLqav3h9RXqkus6rSM5xbbSn7SexWylLHkFokYTbT7Z0VlRfLkyyHJGpvss3F4ISqn14B5xMMoVTwl59OAucRKzxWzNB9dXtTeBkkraKwn7x5DFwMtU3OjkVVN/X7Y/AySR5KCc+vV5+89tKDrhOcvTCteGg+vyfvyKK08CFWfYaMbFdXq+bh489UPL6VL6dbcYq9tfszZ1Odmb/eovxXYABANX4y8lpeJPvAAAAAElFTkSuQmCC';
    var subLogoBase64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAjCAYAAACD1LrRAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OEI1RjY4NDUxRDZBMTFFOUE4RDFFN0U4QTI5OEY1QTYiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OEI1RjY4NDYxRDZBMTFFOUE4RDFFN0U4QTI5OEY1QTYiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo4QjVGNjg0MzFENkExMUU5QThEMUU3RThBMjk4RjVBNiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo4QjVGNjg0NDFENkExMUU5QThEMUU3RThBMjk4RjVBNiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Po45Ew4AAAM+SURBVHja1FdNTxNBGH5md3a7uy0ttFAKxLbiVzRqQoxHo/HixYshHvTgyaN/wP/gP/BuvKmJidGoiZGoxEQI8WACBCQIgqVAbWG77HZ9Z1qJSKGN/SC+yXS2+87MM+8zz7wzy3zPWQHjFnw3j1Ya491wC+PQMkNL86vgULRo2aEZaLVpVmhpoYjnH5YJuK3mh0fGFm67rmO3FXjLZXEw9b6pq7sjvjexLuuLiTLzb77bsr55JIgH04XtZ2FPvm4gxBVcTVl4/W0TM3kXh0McSSp/9usPlmEUBnAVKNLzLuCfro9b1PgFDSQG6TVU9BiK7Cx8lxMBTKw4eJ9xcPdsBNmih4fTeRTId40m8IgmMzwYxIrt4VhE2wb925RqwKLzhd6dWrPpvfBtUrnUb6KDM0ytb2GSSpwmJ+zdUlFOth7b1epG2sKZqC4HFTOmlZHvNz1f+s7HA/L/nVNhjC7bsIjq4UETH5eL0idqYaJvtDKhqrvLJ6uqP+EUdeWBVWtDPsaq96tmnlfC05cjKBTye2+n350Z2ycnsL371TIFB2QHBsx3rpmPouM2J0fRWKqqQNd4bWC7uIXxL3O0TgyKwhoCFmMleiI4nk7UBjYCGoZOppoYsVof1YxkKsDbvsa2Q5loZkluE8Yao1poJdYZQmogVhtY5xyDyThYEyIqEdUar5NqIaigqbef6k3bwefJeUmzwhpXdTwWxtFUb21gQU2yLyYTX4O4Mi+bhl5fxJyAe7sj7ae6SKqenvtRl6qFanuiHeiPdzYOrCoKusLW9p7ez1zPg2XozYlYUN33jxH8P6dTZi2fKSHQrfq2VLPIsYLmrkiw4YNiX+DFmbErOSRHGfM587doG5SPs3On09CV1l27lRDf+NSpLl4PmgYs05SHRDsOCr64nIXnLj62dWc2PnAizbmPUslrPbDrulJj2WyG2Z6G1KGUpLrlqiajHxWGYbG11SxmZ6ekuDjnLQATqViRAt4xesAwsJ5bxdzcDBKxIDSKXCSKplBLOcJxhHg9mahoRVnlIk66JsotK4hcLodnr96i4ZOiykVf101wXQd9gJQqmaRExaNPixLdDOkzkrdqnQmHMH4JMACysSImPJb8UwAAAABJRU5ErkJggg==';

    var printIconBase64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MDBGNkZGMzAxRDZCMTFFOTg2ODNDMUQ1N0Q0MjhDMUQiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MDBGNkZGMzExRDZCMTFFOTg2ODNDMUQ1N0Q0MjhDMUQiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDowMEY2RkYyRTFENkIxMUU5ODY4M0MxRDU3RDQyOEMxRCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDowMEY2RkYyRjFENkIxMUU5ODY4M0MxRDU3RDQyOEMxRCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PqaksRgAAAQ3SURBVHjahJRdbFRVFIW/PXNnOtOB/tCWlkKxFYQYCwJCMVTggYRgIGI0xCJo5IkIVV+JPy9qDPKgQYgGE3+igQRN8AEKNRpUYkQ0EkMBK0IoWqgFCm2HmenMtHNcc2cUXpCT7Htv7tl7nXX2XnvbnCpIZKG+FB5tMrwAxDwCMypZ3zCOlRPC3F/qUYdWcpS/r6Y50Z/iwPkhdvfEGZsYhT+GHb1x7Y+B5QFHRmF8GB5uMJZNYe3cibw+PsrdeRC0xxiFFZR5hc8bKc7/cImXT15jT2/SMTgCw/IN1onZlRQ4Ob0y37Y/2Mi2kiCVyMnpVNKybNHEHmeYAsNhKqdV83h1CVVfXuDQUEbbJsA85atC377I3lnWzPMkFaMrkFPwvfOgtgEmTRYzeV8aLrAMmc/c5FY1kYXhtNXs6uZgVjHBCSXQ3myrN7byNkMCS+e5RrGntmF192HRKqx0OrbmNWz2EujcV2AaMf9QE7MZU2lJJ+zErwN0B5dPwbYutKNekIjLXy8hm9cK9yyFg28pSBE9Z1WpkABXYk2NcKRTSPIrMT+/ptdDNaz4K2HbAqsbbW1JGRU+kP1rynxvF0ydi7U+jS1YATV34T5cpwomsS0fFXI7WvRXDSxG+ZJJrAuoym156s64ucbk6ansuSwuNYRzonHkY6xlAy6vjQVt2Mpn4LLz3f1YYcwo5wmvPsYs/7R8XnJy6Nd7oAcy8+F4BwzpO6BKfPUz7utO/4pu8DRWratriwrFxISozEgxs8xttIQ0U+qfNaRn82IxeQSaWnAdOwWW8PVgZbW4sTSWrcYpx1ZRhzv8Ofy4oyApgQo2eROw32HL18Cmz/jfNRr/iUB0sp+WYO4Sv32/wL2qHMcUH7akdyPD5XElrtFPcMtj3Gm5N1o32NJn2wWYdl0dH9gLnV3Uj8MG4iSMK97FJCdnltHoCzY1fEdAe/HYt3jRGJmks5a160nfKLSmang1xSnvzCB7Z9azyvI/I2W3UNGPK73F3r1FApGKGrKqQLRcIKUxSQAL5HwX9fVeb/+fbs+KBtsZirlyd+qwNNemJKsXO97UyaIdoaDc/3KowmVDMGcxTFsEF45rKiTJ5Bje1+N2BzWSXCJr3YtnW5ud/EU668cO78BdPotVVipYqs3cYjlZ6jruOymg/wz2xRb9S/D+GZ480sdpm1cNF6WMXUtt5+pmt5nfddtwcUyN3CaRgULOTIMEzY1v+uy9l466TfnJ5VXrShHd7JNu1z67ylxTE+1+PqUtV36bwlA8sEY9kODd/efc5vw8LZMFp6sOmsjUxSCetkPxEc7WxnggFKbCgoURhSsCiZmFCoM2mebCsT6e6xlk63XVaEC3CWnfc8U8a6j6U7vrGrs1wffWj2d9TYRVFWFmRYPU+m2QoT+epKsvSce5QT4dzDCq/iUULHRtfv0jwABo9ppeNmmlygAAAABJRU5ErkJggg==';

    var calendarIconBase64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QkI5OEM0MjIxRDZCMTFFOUIwNkRFMTFDRjBENkVBQzciIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QkI5OEM0MjMxRDZCMTFFOUIwNkRFMTFDRjBENkVBQzciPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpCQjk4QzQyMDFENkIxMUU5QjA2REUxMUNGMEQ2RUFDNyIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpCQjk4QzQyMTFENkIxMUU5QjA2REUxMUNGMEQ2RUFDNyIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PgyurLkAAAQySURBVHjabFVtaJtVFH7ufd8kTdJ8td3q0qbZrB1Ua9WiOKwfkykbVTYp1M9VUfFH/aGgyIb+dKCCFnF/BlOUuQmb1Q0/+mNsCv4Qi9soVqxDWrtlrE2Wdk3ytsmS997ruW9e21R3Idz3nnvuOc855zknTAx5UV0MUIp2VT0q+TSD2kmy2+gUd5XmwNi4Av+W9iNaSzH9lIOp6jv2P4NK9DMl3yVjHY5dLa9ZzHVI8inF+JuKG8fI+IpBXqOpUb3DpPgKkox56OxdBexaqcr0nVTtpHuUSfm++9j5mc5Be5D224C9l0mSXwNOXg0jp+owEMwAwjVoAF/Pr0Mdq6DPv1g1zu3XmVCCkO5xordf9hNcsZXZ5R8ZPbT8UUzd/CheHEkjY9n4Zncz8gXpYAiHOfqPpBH0mTj0RDPaJ0cRWl6AIkfK9G1XzDhpaqBc2J85CIrARPJ+DPd+jh3ndsFjZfBxz34sWktO7sKhMAZ/eQzCW4d9pPPqwgDu+2MEqKe3ovKpMnmLyaW9nXKX1GGDK9jCRm56GnVbn4JHlVG4MIEA7XoV5n1I7HgJghlYnJ5Bxa5Uq+AURca5FDtN+hhYSTrlL0KYt4RsGJEulG2BHjsPW5nONSkjb3bDMA1sUTZiOj5ZwwAlHjeJKnc76HSNLKA7uQHJBzuwfDmFSDiMfD6PYCDgoFiyLIQjERSsAvzxBMLpONQYPQxVUVKkdxFgdVMtQvh8EAZDoViiZJuwSiWUdaJNDwy6C0SiKJYr8GkMjSGq6hqatpkuA1e5WC5T7oBYQwOFZiIaa4DP74eXwpz88zx+PjuOS7NzMFpm0f3TOdxDkBjRx02zTimbWuPDMGCRwStXsigWi8hms/CQ7NTpH/DRwU/Q0NSEvoe34YHOdvzduxffR1uBBfUvrIvUhGwMqqYdpESALmOxKEXvQzSqdy9SmSyee3YQm2/ciE1tCXQm1+OZRx5CZeg4JhZNagxtlJ/hxPCRNQg5d1IphCA/VUeXLs+S4Rh67+xBiXJ74IujOHD4mBNB/JY78NeGzQ6HidhfmpIZowbjKapQAjrBvnosE8Kr/hYEgkBOBvUwQTmSRqlURDLRivpgCB2b2uCn3JZyZSju0CqtOD9h6g6gaj5PrXcKDeTl7Amsb+rAOppLBqGtl8Lh7m9nZjBz6z6tgt27+lYCys2lkJw9D7TyF3QiySDTHk7DUO+xSGUPUtPwDA+5E4Vq5M6j3kU9GOZhvXEQnY3AMsl+HafAhvtxe/Dah9TLo0zImnmoiSnEBzR1XsN1FiMH6QvA2A1dWEreC1kpomnyOLbx/H4z7n1FlpxW+c+A1WNTiif1XKTvjaty90u3Wp6GXI54buAiGvEWAt7DwiayuD3Irv8XQANJqUH3L6CLBM2uUoYi+Z2C+Y7ocIgCrCinbdnKJP9HgAEAPlSxrjbnVYgAAAAASUVORK5CYII=';

    var checkBoxIcon = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QkEwMDJBRjUxRDcyMTFFOTk1RTJFQUU5NkMxMURDQTciIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QkEwMDJBRjYxRDcyMTFFOTk1RTJFQUU5NkMxMURDQTciPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpCQTAwMkFGMzFENzIxMUU5OTVFMkVBRTk2QzExRENBNyIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpCQTAwMkFGNDFENzIxMUU5OTVFMkVBRTk2QzExRENBNyIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PjYTHtUAAASASURBVHjaRFRbiFZlFN3fPt93zn+bcS6OqQ1jCiNM6EMYlA/S5SHLgpKMMKMpCGTKRPDJ6klMCHopMamHMAOjfNCCyl5iBCOGtIfIClGwSEP9mxn/+znnu7T2+bF+OP/tfGfttddae6ufmi+RIiYXehTIk/eOSDlyPn3cht52CmqTD+kEETtW/FvE5dlIJUdMVP01d23yIaNEj1BmG2SiGmm6/VICa8hS9wHc/NT7dIUnVxRjZXDAR7lP12WuvS5SZpfzA9+RimZYRRcDhTWOsrFY6TkAKhxmQlXq2usHe/nCvgAgzeXrMZePKYrOgn1dkTIlHlluffcZ6ztPd+zNh8t6bLeJBnd18munM3trMuGhxwAIFkpTzy683slu7FMqojha8qHmyk4TJWjdknMp6nLRErP5zFt3X4lL2xI99HbPzv9gXWdSocNuXv9EB/BL3fzmdv73W5GKKTHDu1nFhwogXCE4ktZZPuXyGZX0yByr8lw7vTLrQn6/glSiO/TdqxnsUrt4IIQcYKMf1cz4IVSlwB6loA7ewRmHYxToFkw1lwjdnAPYBtFYuqyalQ8xDczq3DU3QpN7NVfbsV6yJ/NtSMCASCgPnYJV2SyD0mjJ3hStK6306jnre1PQt0jGYDKxMRDfVCGs5Mw3t/tgxYTjIdimdQ2A5CBiCvPFIDFOiuAyqV340fp0SjQrwEqrNqGPkUbv0iVP3bUMTdZL2zoqfyvxiKMByn1rVy+f/1zM6oOBSfDDuWv87n1+t+rnDMyXPgG9z/by+k6RJvfdtTAlTMlNBPoiQGHQwt7U3npHHolD7biOKs+BedzOrp6HSatVEbNAFXPHk8zxV9Y30Y3+QxqBBMs1bg8UrQVn5a/ct9dT8DChRLnrbsehhY67tgY6r76tWS0e36o5+TL1iwg9Swnfnw78Usr8LL9x8C5kETlLXjS69r7ERQ6jwCvW9R4VDQPmqGJWPJVEQ6ckSpGqoEQVZNSonLW+dY0V6fPyMAAfYSQg+Bw6Dr1q9OC7YlY/Fl66pGq8cktJj37hAQwt8Z8r2se5DaIhgn+ZkfwTki3otAPRYYSWJOBlPboH03JQlobMeTUZfxD3v5GWERnAiFmxGLEZJk5pFfcMV+a4HA2dMVy7nLnmGFrej7Rj86RSFVpNvAFGhxHal0vR0jOyWcSEFMGX2MiFHB/wRVcDH2hVbqtf2jMI7D/Tt9IrRwtmZtlWT9kpcbMULSt0k3lxGDmZCAfQUJiWUOYaR7EUpvG9VY3vhGlc59S30Hv1Y2TqGEYJA37jJNi9Jhso8/NoqUnt7C/ZRDApLsZOggOwE1hz04Uc8fizhgfrklvuz6sH5dp0ogdPynccfA/LE7nLdmPRTqJVxEFrSHFP5lr7U9dYBOA2Zi1GvQBtv3aQSKZenW8+XzgJYYuJyF1nJnetwwLSnxKpykXKim1DuWxPsNV/xnp4C1bYhRD6K0TI8X8bW5gGyVZ8pGzGhmDGmwj399jIWejnFCBRHU6eLpmRHUjDKshywRfM/n/9K8AAT+VpNg6XlN8AAAAASUVORK5CYII=';

        function Export(metaData, reportName, data, takenBy, serverDate, widthType, layout, headerRows=1) {
                    modifiedMetaData = [];
                    $.each(metaData, function(index, md){
                        modifiedMetaData.push({ image: checkBoxIcon, style:'checkBoxIconStyle', width:8});
                        modifiedMetaData.push({'text':md, style:'paramateresTextStyle'});
                    })

                    console.log(modifiedMetaData);
            
                    var docDefinition = {
                        watermark: {text: 'QixTix | Automated Fare Collection System', color: '#367fa9', opacity: 0.05, bold: true, italics: false, fontSize: 8},
                        pageSize: 'A4',
                        pageOrientation: 'landscape',
                        pageMargins: [ 0, 120, 0, 20 ],
                        header: {
                            columns: [
                                {
                                    stack: [
                                        {
                                            table: {
                                                widths: [50, '*'],
                                                body: [[{ image: mainLogoBase64, style:'topLogoStyle', width:25},{'text':'QixTix | Automated Fare Collection System', style:'topHeader'}]]
                                            },
                                            layout: 'noBorders'
                                        },
                                        {
                                            table: {
                                                widths: '*',
                                                body: [[{'text':reportName, style:'middleHeader'}]]
                                            },
                                            layout: 'noBorders',
                                            margin: [0, 10, 0, 0]
                                        },
                                        {
                                            table: {
                                                widths: [3, '*', 3, '*', 3, '*', 3, '*', 3, '*', 3, '*'],
                                                body: [modifiedMetaData]
                                            },
                                            layout: 'noBorders',
                                            margin: [20, 15, 20, 0]
                                        }
                                    ],
                                    width: '*'
                                }
                            ]
                        },
                        footer: function(currentPage, pageCount)
                        {
                            return {
                                columns: [
                                    { image: printIconBase64, style:'footerIconStyle', width:10 },
                                    { text: 'Print taken By : '+ takenBy, style:'footerTextStyle' },
                                    { text: 'Page '+currentPage+' of '+pageCount, style:'footerTextStyle' },
                                    { image: calendarIconBase64, width:10, alignment:'right' },
                                    { text: serverDate, style:'footerTextStyle', alignment:'right', width:'79' }
                                ],
                                margin: [20, 0, 20, 0]
                            }
                        },
                        content: [
                        {
                            style: 'tableStyle',
                            table:{
                                headerRows: headerRows,
                                widths: widthType,
                                body: data
                            },
                            layout: layout,
                            margin: [20, 0, 20, 0]
                        }],
                        styles: {
                            topHeader: {
                                fontSize: 16,
                                bold: true,
                                alignment: 'center',
                                marginTop: 8, 
                                color: '#fff',
                                fillColor:'#253135',
                                paddingTop:10
                            },
                            middleHeader: {
                                fontSize: 12,
                                alignment: 'center',
                                marginTop: 8,
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
                                fillColor: '#367fa9',
                                color: '#fff',
                                bold: true,
                                alignment: 'left'
                            },
                            topLogoStyle: {
                                fillColor:'#253135',
                                margin: [10, 5, 10, 5]
                            },
                            middleLogoStyle: {
                                fillColor:'#fff',
                                marginLeft: -80
                            },
                            footerIconStyle: {
                                marginRight: 20
                            },
                            footerTextStyle: {
                                marginLeft: 5,
                                fontSize: 8
                            },
                            reportNameTextStyle: {
                                marginLeft: 25,
                                marginTop: 10
                            },
                            paramateresTextStyle: {
                                fontSize: 10,
                                alignment: 'left',
                                bold: true,
                                marginTop: -2
                            },
                            checkBoxIconStyle: {
                                alignment: 'left'
                            },
                            oddRowStyle: {
                                fillColor: '#ebf2f3'
                            }
                        }
                    };
                    pdfMake.createPdf(docDefinition).download(reportName+'.pdf');
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

        $(document).on('change', '#shift_id', function(){
            clearReportData();
        });

        $(document).on('change', '#status_type', function(){
            clearReportData();
        });

        $(document).on('change', '#etm_no', function(){
            clearReportData();
        });

        $(document).on('change', '#denomination_id', function(){
            clearReportData();
        });

        $(document).on('change', '#route_id', function(){
            clearReportData();
        });

        $(document).on('change', '#pending_activity', function(){
            clearReportData();
        });

        $(document).on('change', '#direction', function(){
            clearReportData();
        });

        $(document).on('change', '#concession_id', function(){
            clearReportData();
        });

        $(document).on('change', '#date', function(){
            clearReportData();
        });

        $(document).on('change', '#service_id', function(){
            clearReportData();
        });

        $(document).on('keyup', '#bus_no', function(){
            clearReportData();
        });

        $(document).on('keyup', '#conductor_id', function(){
            clearReportData();
        });

        $(document).on('keyup', '#time_slot', function(){
            clearReportData();
        });
});
function clearReportData()
{
    $('#reportDataBox').remove();
}
function validateForm(depot_id=null, from_date=null, to_date=null, etm_no=null, time_slot=null, direction=null, service_id=null, date=null, route_id=null)
{
    if(depot_id)
    {
        var depotId = $('#'+depot_id).val();
        if(!depotId)
        {
            alert('Please select a depot.');
            return false;
        }
    }

    if(from_date)
    {     
        var fromDate = $('#'+from_date).val();
        if(!fromDate)
        {
            alert('Please enter from date.');
            return false;
        }
    }

    if(to_date)
    {
        var toDate = $('#'+to_date).val();
        if(!toDate)
        {
            alert('Please enter to date.');
            return false;
        }
    }
    
    if(from_date && to_date)
    {
        var splitFrom = fromDate.split('-');
        var splitTo = toDate.split('-');

        console.log(splitFrom)

        //Create a date object from the arrays
        fromDate = new Date(splitFrom[2], splitFrom[1]-1, splitFrom[0]);
        toDate = new Date(splitTo[2], splitTo[1]-1, splitTo[0]);

        if(fromDate > toDate)
        {
            alert('From Date must be smaller than or equal to To Date.');
            return false;
        }
    }

    if(date)
    {
        var toDate = $('#'+date).val();
        if(!toDate)
        {
            alert('Please enter date.');
            return false;
        }
    }

    if(etm_no)
    {
        var etm_no = $('#'+etm_no).val();
        if(!etm_no)
        {
            alert('Please enter ETM number.');
            return false;
        }
    }

    if(time_slot)
    {
        var time_slot = $('#'+time_slot).val();
        if(!time_slot)
        {
            alert('Please enter time slot.');
            return false;
        }
    }

    if(direction)
    {
        var direction = $('#'+direction).val();
        if(!direction)
        {
            alert('Please select direction.');
            return false;
        }
    }

    if(service_id)
    {
        var service_id = $('#'+service_id).val();
        if(!service_id)
        {
            alert('Please select a service.');
            return false;
        }
    }

    if(route_id)
    {
        var route_id = $('#'+route_id).val();
        if(!route_id)
        {
            alert('Please select a route.');
            return false;
        }
    }

    return true;
}

function numvalidate(e) 
{
    var key;
    var keychar;
    if (window.event)
        key = window.event.keyCode;
    else if (e)
        key = e.which;
    else
        return true;
    keychar = String.fromCharCode(key);
    keychar = keychar.toLowerCase();
    // control keys
    if ((key == null) || (key == 0) || (key == 8) || (key == 9)
    || (key == 13) || (key == 27))
        return true;
    else if (!(("1234567890").indexOf(keychar) > -1)) {
        return false;
    }
}


function getETMsByDepotId(depotId, idToAppend, type="All", selected)
{
    var url = "{{route('reports.etm.audit_status.getetmsbydepotid', ':depotId')}}";
    url = url.replace(":depotId", depotId); 
    console.log(url);
    $.ajax({
        url:url,
        type:"GET",
        dataType: "JSON",
        success: function(response)
        {
            if(type=="All")
                var str = "<option value=''>All</option>";
            else
                var str = "<option value=''>Select ETM Number</option>";

            $.each(response, function(index, etm){
                if(etm.etm_no == selected)
                    str += "<option value='"+etm.etm_no+"' selected>"+etm.etm_no+"</option>";
                else
                    str += "<option value='"+etm.etm_no+"'>"+etm.etm_no+"</option>";
            });

            $('#'+idToAppend).html(str);
        },
        error: function(error)
        {
            console.log(error);
        }
    });
}

function getConductorsByDepotId(depotId, idToAppend, type="All", selected)
{
    var url = "{{route('reports.getconductorsbydepotid', ':placeholder')}}";
    url = url.replace(":placeholder", depotId); 
    console.log(url);
    $.ajax({
        url:url,
        type:"GET",
        dataType: "JSON",
        success: function(response)
        {
            if(type=="All")
                var str = "<option value=''>All</option>";
            else
                var str = "<option value=''>Select Conductor</option>";

            $.each(response, function(index, conductor){
                if(conductor.crew_id == selected)
                    str += "<option value='"+conductor.crew_id+"' selected>"+conductor.crew_name+"</option>";
                else
                    str += "<option value='"+conductor.crew_id+"'>"+conductor.crew_name+"</option>";
            });

            $('#'+idToAppend).html(str);
        },
        error: function(error)
        {
            console.log(error);
        }
    });
}
</script>