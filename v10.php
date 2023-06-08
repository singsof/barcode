<!DOCTYPE html>
<html>

<head>
    <title>Barcode Scanner</title>
    <style>
        #scanner-container {
            position: relative;
            width: 400px;
            height: 250px;
            background-color: black;
            /* padding: 20px; */
        }

        #preview {
            position: absolute;
            width: 400px;
            height: 250px;
        }

        #scanner-frame {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            height: 30%;
            border: 2px solid #ff0000;
            pointer-events: none;
        }

        /* #scanner-line {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #ff0000;
            pointer-events: none;
        } */

        #scanner-line {
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: #ff0000;
            pointer-events: none;
            animation-duration: 2s;
            animation: 1.5s linear 2s infinite alternate slidein;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
            animation-name: scan-vertical;

        }

        @keyframes scan-horizontal {
            0% {
                left: 0;
            }

            100% {
                left: 100%;
            }
        }

        @keyframes scan-vertical {
            0% {
                top: 10%;
            }

            100% {
                top: 90%;
            }
        }
    </style>
</head>

<body>
    <h1>Barcode Scanner</h1>

    <!-- <center> -->
    <div id="scanner-container">
        <video id="preview"></video>
        <div id="scanner-frame"></div>
        <div id="scanner-line" class="scanner-line"></div>
        <!-- <div id="horizontal-line" class="scanner-line"></div>
        <div id="vertical-line" class="scanner-line"></div> -->
    </div>
    <!-- </center> -->


    <!-- <script src="https://unpkg.com/@zxing/library@latest"></script> -->
    <script src="./index.min.js"></script>
    <script>
        const codeReader = new ZXing.BrowserBarcodeReader();
        const videoElement = document.getElementById('preview');

        const decodeFormats = [
            ZXing.BarcodeFormat.UPC_A,
            ZXing.BarcodeFormat.UPC_E,
            ZXing.BarcodeFormat.EAN_8,
            ZXing.BarcodeFormat.EAN_13,
            ZXing.BarcodeFormat.CODE_39,
            ZXing.BarcodeFormat.CODE_93,
            ZXing.BarcodeFormat.CODE_128,
            ZXing.BarcodeFormat.ITF,
            ZXing.BarcodeFormat.CODABAR,
            ZXing.BarcodeFormat.MSI,
            ZXing.BarcodeFormat.RSS_14,
            ZXing.BarcodeFormat.RSS_EXPANDED,
            ZXing.BarcodeFormat.RSS_LIMITED,
            ZXing.BarcodeFormat.UPC_EAN_EXTENSION,
            ZXing.BarcodeFormat.QR_CODE,
            ZXing.BarcodeFormat.DATA_MATRIX,
            ZXing.BarcodeFormat.PDF_417,
            ZXing.BarcodeFormat.AZTEC
        ];


        // console.log(decodeHints)
        codeReader
            .getVideoInputDevices()
            .then((videoInputDevices) => {
                // console.log(videoInputDevices[0].deviceId)

                if (videoInputDevices.length > 0) {
                    const constraints = {
                        deviceId: videoInputDevices[0].deviceId,
                        decodeFormats: decodeFormats
                    };
                    codeReader.decodeFromVideoDevice(undefined, videoElement, (result, error) => {
                        if (result) {
                            console.log(result.text);
                            // Handle the decoded barcode value here
                        }

                        if (error && !(error instanceof ZXing.NotFoundException)) {
                            console.error(error);
                        }
                    }, constraints);
                } else {
                    console.error('No video input devices found');
                }
            })
            .catch((err) => {
                console.error(err);
            });
    </script>
</body>

</html>