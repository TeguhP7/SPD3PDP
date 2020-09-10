<?php
class Laporan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('Pdf_tcpdf');
    }


    function inventaris()
    {
        // Include the main TCPDF library (search for installation path).
        // require_once('tcpdf_include.php');

        // create new PDF document
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Anonim');
        $pdf->SetTitle('Laporan Inventaris');
        $pdf->SetSubject('Laporan');
        $pdf->SetKeywords('Laporan, Cetak, Inventaris');

        // set default header data
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 041', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('times', '', 12);

        // add a page
        $pdf->AddPage();
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.1, 'depth_h' => 0.1, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        $pdf->Image('assets/img/white.jpg', 0,  0, 200, 27, 'JPG', '', '', true);
        $pdf->Image('assets/img/white.jpg', 200,  0, 200, 27, 'JPG', '', '', true);
        $pdf->Image('assets/img/logo.jpg', 70,  8, 20, 24, 'JPG', '', '', true);
        $pdf->Text(115, 10, 'PEMERINTAH KABUPATEN KUDUS');
        $pdf->Text(125, 15, 'KECAMATAN KOTA KUDUS');
        $pdf->Text(133, 20, 'DESA GUNUNG PATI');
        $pdf->Text(97, 25, 'Ds. Gunung Pati, Kec. Gunung Pati, Semarang, Jawa Tengah 50229');
        $pdf->Rect(15, 33.5, 267, 0, 'D');
        $pdf->Rect(15, 34.2, 267, 0.2, 'D');
        $pdf->Rect(15, 34.5, 267, 0.2, 'D');
        $pdf->Rect(15, 34.8, 267, 0, 'D');
        // mencetak string 
        $pdf->Cell(10, 14, '', 0, 1);
        $pdf->Cell(270, 5, 'LAPORAN ASET INVENTARIS DESA GUNUNG PATI', 0, 1, 'C');

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 1, '', 0, 1);
        $pdf->Cell(12, 6, 'No.', 1, 0, 'C');
        $pdf->Cell(54, 6, 'Nama Aset', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Jumlah', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Kondisi', 1, 0, 'C');
        $pdf->Cell(146, 6, 'Keterangan Lain', 1, 1, 'C');

        // ---------------------------------------------------------
        $this->load->model('Inventaris_model');
        $inventaris = $this->Inventaris_model->ambil_data();
        $no = 1;
        foreach ($inventaris as $row) {

            $pdf->Cell(12, 6, $no . '.', 1, 0, 'C');
            $pdf->Cell(54, 6, $row->nama_aset, 1, 0);
            $pdf->Cell(25, 6, $row->jumlah, 1, 0, 'C');
            $pdf->Cell(30, 6, $row->kondisi, 1, 0, 'C');
            $pdf->Cell(146, 6, $row->keterangan_lain, 1, 1);
            $no++;
        }
        //Close and output PDF document
        if ($this->session->userdata('status') == 'admin') {
            $pdf->Output('Laporan Inventaris.pdf', 'I');
        }
    }


    function pembelian()
    {
        // Include the main TCPDF library (search for installation path).
        // require_once('tcpdf_include.php');

        // create new PDF document
        // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Anonim');
        $pdf->SetTitle('Laporan Pembelian Desa Gunung Pati');
        $pdf->SetSubject('Laporan');
        $pdf->SetKeywords('Laporan, Cetak, Pembelian');

        // set default header data
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 041', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('times', '', 12);

        // add a page
        $pdf->AddPage();
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.1, 'depth_h' => 0.1, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        $pdf->Image('assets/img/white.jpg', 0,  0, 200, 27, 'JPG', '', '', true);
        $pdf->Image('assets/img/white.jpg', 200,  0, 200, 27, 'JPG', '', '', true);
        $pdf->Image('assets/img/logo.jpg', 70,  8, 20, 24, 'JPG', '', '', true);
        $pdf->Text(115, 10, 'PEMERINTAH KABUPATEN SEMARANG');
        $pdf->Text(125, 15, 'KECAMATAN GUNUNG PATI');
        $pdf->Text(133, 20, 'DESA GUNUNG PATI');
        $pdf->Text(97, 25, 'Ds. Gunung Pati, Kec. Gunung Pati, Semarang, Jawa Tengah 50229');
        $pdf->Rect(15, 33.5, 267, 0, 'D');
        $pdf->Rect(15, 34.2, 267, 0.2, 'D');
        $pdf->Rect(15, 34.5, 267, 0.2, 'D');
        $pdf->Rect(15, 34.8, 267, 0, 'D');

        // mencetak string 
        $pdf->Cell(10, 14, '', 0, 1);
        $pdf->Cell(270, 5, 'LAPORAN PEMBELIAN BARANG DESA GUNUNG PATI', 0, 1, 'C');

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 1, '', 0, 1);
        $pdf->Cell(12, 6, 'No.', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Nama Barang', 1, 0, 'C');
        $pdf->Cell(55, 6, 'Nama Pegawai', 1, 0, 'C');
        $pdf->Cell(35, 6, 'Tanggal', 1, 0, 'C');
        $pdf->Cell(40, 6, 'Harga Satuan', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Jumlah', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Total Belanja', 1, 1, 'C');
        // ---------------------------------------------------------

        $this->load->model('Pembelian_model');
        $pembelian = $this->Pembelian_model->ambil_data();

        $no = 1;
        foreach ($pembelian as $row) {
            $pdf->Cell(12, 6, $no . '.', 1, 0, 'C');
            $pdf->Cell(50, 6, $row->nama_barang, 1, 0);
            $pdf->Cell(55, 6, $row->nama_pegawai, 1, 0);
            $pdf->Cell(35, 6, $row->tanggal, 1, 0, 'C');
            $pdf->Cell(40, 6, $row->harga_satuan, 1, 0,);
            $pdf->Cell(25, 6, $row->jumlah_barang, 1, 0, 'C');
            $pdf->Cell(50, 6, $row->total_belanja, 1, 1);
            $no++;
        }
        //Close and output PDF document
        if ($this->session->userdata('status') == 'admin') {
            $pdf->Output('Laporan Pembelian.pdf', 'I');
        }
    }


    function pinjam_barang()
    {
        // Include the main TCPDF library (search for installation path).
        // require_once('tcpdf_include.php');

        // create new PDF document
        // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Anonim');
        $pdf->SetTitle('Laporan Barang (Peminjaman) Desa Gunung Pati');
        $pdf->SetSubject('Laporan');
        $pdf->SetKeywords('Laporan, Cetak, Peminjaman, Barang');

        // set default header data
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 041', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('times', '', 12);

        // add a page
        $pdf->AddPage();
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.1, 'depth_h' => 0.1, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        $pdf->Image('assets/img/white.jpg', 0,  0, 200, 27, 'JPG', '', '', true);
        $pdf->Image('assets/img/white.jpg', 200,  0, 200, 27, 'JPG', '', '', true);
        $pdf->Image('assets/img/logo.jpg', 70,  8, 20, 24, 'JPG', '', '', true);
        $pdf->Text(115, 10, 'PEMERINTAH KABUPATEN SEMARANG');
        $pdf->Text(125, 15, 'KECAMATAN GUNUNG PATI');
        $pdf->Text(133, 20, 'DESA GUNUNG PATI');
        $pdf->Text(97, 25, 'Ds. Gunung Pati, Kec. Gunung Pati, Semarang, Jawa Tengah 50229');
        $pdf->Rect(15, 33.5, 267, 0, 'D');
        $pdf->Rect(15, 34.2, 267, 0.2, 'D');
        $pdf->Rect(15, 34.5, 267, 0.2, 'D');
        $pdf->Rect(15, 34.8, 267, 0, 'D');

        // mencetak string 
        $pdf->Cell(10, 14, '', 0, 1);
        $pdf->Cell(270, 5, 'LAPORAN DATA BARANG PEMINJAMAN DESA GUNUNG PATI', 0, 1, 'C');

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 1, '', 0, 1);

        $pdf->Cell(12, 16, 'No.', 1, 0, 'C');
        $pdf->Cell(50, 16, 'Nama Barang', 1, 0, 'C');
        $pdf->Cell(25, 16, 'Jumlah', 1, 0, 'C');
        $pdf->MultiCell(37, 16, 'Harga Sewa (Per-Barang & Hari)', 1, 'C', 0, 0, '', '', true, 0, false, true, 16, 'M');
        $pdf->Cell(143, 16, 'Keterangan Lain', 1, 1, 'C');
        // ---------------------------------------------------------

        $this->load->model('Pinjam_barang_model');
        $pinjam_barang = $this->Pinjam_barang_model->ambil_data();

        $no = 1;
        foreach ($pinjam_barang as $row) {
            $pdf->Cell(12, 6, $no . '.', 1, 0, 'C');
            $pdf->Cell(50, 6, $row->nama_barang, 1, 0);
            $pdf->Cell(25, 6, $row->jumlah, 1, 0, 'C');
            $pdf->Cell(37, 6, $row->harga_sewa, 1, 0);
            $pdf->Cell(143, 6, $row->keterangan_lain, 1, 1);
            $no++;
        }
        //Close and output PDF document
        $pdf->Output('Laporan Barang Peminjaman.pdf', 'I');
    }

    function peminjaman()
    {
        // Include the main TCPDF library (search for installation path).
        // require_once('tcpdf_include.php');

        // create new PDF document
        // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Anonim');
        $pdf->SetTitle('Laporan Peminjaman Desa Gunung Pati');
        $pdf->SetSubject('Laporan');
        $pdf->SetKeywords('Laporan, Cetak, Peminjaman');

        // set default header data
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 041', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('times', '', 12);

        // add a page
        $pdf->AddPage();
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.1, 'depth_h' => 0.1, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        $pdf->Image('assets/img/white.jpg', 0,  0, 200, 27, 'JPG', '', '', true);
        $pdf->Image('assets/img/white.jpg', 200,  0, 200, 27, 'JPG', '', '', true);
        $pdf->Image('assets/img/logo.jpg', 70,  8, 20, 24, 'JPG', '', '', true);
        $pdf->Text(115, 10, 'PEMERINTAH KABUPATEN SEMARANG');
        $pdf->Text(125, 15, 'KECAMATAN GUNUNG PATI');
        $pdf->Text(133, 20, 'DESA GUNUNG PATI');
        $pdf->Text(97, 25, 'Ds. Gunung Pati, Kec. Gunung Pati, Semarang, Jawa Tengah 50229');
        $pdf->Rect(15, 33.5, 267, 0, 'D');
        $pdf->Rect(15, 34.2, 267, 0.2, 'D');
        $pdf->Rect(15, 34.5, 267, 0.2, 'D');
        $pdf->Rect(15, 34.8, 267, 0, 'D');

        // mencetak string 
        $pdf->Cell(10, 14, '', 0, 1);
        $pdf->Cell(270, 5, 'LAPORAN PEMINJAMAN ASET DESA GUNUNG PATI', 0, 1, 'C');

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 1, '', 0, 1);

        $pdf->Cell(11, 18, 'No.', 1, 0, 'C');
        $pdf->Cell(46, 18, 'Nama Peminjam', 1, 0, 'C');
        $pdf->Cell(45, 18, 'Nama Barang', 1, 0, 'C');
        $pdf->Cell(20, 18, 'Jumlah', 1, 0, 'C');
        $pdf->MultiCell(33, 18, 'Harga Sewa (Per-Barang & Hari)', 1, 'C', 0, 0, '', '', true, 0, false, true, 18, 'M');
        $pdf->MultiCell(35, 18, 'Tanggal Peminjaman', 1, 'C', 0, 0, '', '', true, 0, false, true, 18, 'M');
        $pdf->MultiCell(35, 18, 'Tanggal Pengembalian', 1, 'C', 0, 0, '', '', true, 0, false, true, 18, 'M');
        $pdf->Cell(42, 18, 'Status', 1, 1, 'C');
        // ---------------------------------------------------------

        $this->load->model('Peminjaman_model');
        $peminjaman = $this->Peminjaman_model->ambil_data();

        $no = 1;
        foreach ($peminjaman as $row) {
            $pdf->Cell(11, 6, $no . '.', 1, 0, 'C');
            $pdf->Cell(46, 6, $row->nama_peminjam, 1, 0);
            $pdf->Cell(45, 6, $row->nama_barang, 1, 0);
            $pdf->Cell(20, 6, $row->jumlah, 1, 0, 'C');
            $pdf->Cell(33, 6, $row->harga_sewa, 1, 0);
            $pdf->Cell(35, 6, $row->tanggal_peminjaman, 1, 0);
            $pdf->Cell(35, 6, $row->tanggal_pengembalian, 1, 0);
            $pdf->Cell(42, 6, $row->status, 1, 1);
            $no++;
        }
        //Close and output PDF document
        if ($this->session->userdata('status') == 'admin') {
            $pdf->Output('Laporan Peminjaman.pdf', 'I');
        }
    }

    function coba_cetak()
    {
        // Include the main TCPDF library (search for installation path).
        // require_once('tcpdf_include.php');

        // create new PDF document
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Anonim');
        $pdf->SetTitle('Laporan Inventaris Desa Gunung Pati');
        $pdf->SetSubject('Laporan');
        $pdf->SetKeywords('Laporan, Cetak, Coba');

        // set default header data
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 041', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('times', '', 12);

        // add a page
        $pdf->AddPage();
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.1, 'depth_h' => 0.1, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        $pdf->Image('assets/img/white.jpg', 0,  0, 200, 27, 'JPG', '', '', true);
        $pdf->Image('assets/img/white.jpg', 200,  0, 200, 27, 'JPG', '', '', true);
        $pdf->Image('assets/img/logo.jpg', 70,  8, 20, 24, 'JPG', '', '', true);
        $pdf->Text(115, 10, 'PEMERINTAH KABUPATEN SEMARANG');
        $pdf->Text(125, 15, 'KECAMATAN GUNUNG PATI');
        $pdf->Text(133, 20, 'DESA GUNUNG PATI');
        $pdf->Text(97, 25, 'Ds. Gunung Pati, Kec. Gunung Pati, Semarang, Jawa Tengah 50229');
        $pdf->Rect(15, 33.5, 267, 0, 'D');
        $pdf->Rect(15, 34.2, 267, 0.2, 'D');
        $pdf->Rect(15, 34.5, 267, 0.2, 'D');
        $pdf->Rect(15, 34.8, 267, 0, 'D');
        // mencetak string 
        $pdf->Cell(10, 14, '', 0, 1);
        $pdf->Cell(270, 5, 'LAPORAN ASET INVENTARIS DESA GUNUNG PATI', 0, 1, 'C');

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 1, '', 0, 1);
        $pdf->Cell(12, 6, 'No.', 1, 0, 'C');
        $pdf->Cell(54, 6, 'Nama Aset', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Jumlah', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Kondisi', 1, 0, 'C');
        $pdf->Cell(146, 6, 'Keterangan Lain', 1, 1, 'C');

        // ---------------------------------------------------------
        //Close and output PDF document
        if ($this->session->userdata('status') == 'admin') {
            $pdf->Output('Laporan Coba Cetak.pdf', 'I');
        }
    }
}
