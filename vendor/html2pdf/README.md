This is a fork of [HTML2PDF library](http://html2pdf.fr/en/). Source: [https://github.com/iafan/html2pdf]()

The fork adds the following features:

1. An ability to specify a different first header for the section (with different dimensions) — requires two-pass rendering
2. An ability to specify a different last footer for the section (with different dimensions) — requires two-pass rendering
3. An ability to define an override fonts folder (with a fall back to the default fonts that the library already has)
4. A command-line `php2pdf` script that uses two-pass rendering approach to convert any PHP or HTML to a PDF file