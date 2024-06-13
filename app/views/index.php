<main>
    <div class="container">
        <div class="card">
            <h1 class="title">Fetcher file</h1>
            <div class="header-card">
                <div class="form-group">
                    <label for="txtfetcherCode">Fetcher Code:</label>
                    <input type="text" class="inputField" id="txtfetcherCode" require>
                </div>
                <div class="form-group">
                    <label for="txtfetcherName">Fetcher Name:</label>
                    <input type="text" class="inputField" id="txtfetcherName" require>
                </div>
                <div class="form-group">
                    <label for="txtContactNum">Contact Number:</label>
                    <input type="number" class="inputField" id="txtContactNum" require>
                </div>
                <div class="form-group">
                    <label for="txtregDate">Registered Date:</label>
                    <input type="text" class="inputField date" id="txtregDate" require>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="activeStatus" id="activeStatus">
                    <label class="form-check-label" for="activeStatus">Active</label>
                </div>
            </div>
            <div class="Details">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Student Code</th>
                            <th>Relationship</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="inputField form-select" id=" studentCode1">
                                    <option value="">Select StudentCode</option>
                                    <!-- Options will be added dynamically -->
                                </select>
                            </td>
                            <td>
                                <input type="text" class="inputField" id="relation1">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select class="inputField form-select" id=" studentCode2">
                                    <option value="">Select StudentCode</option>
                                    <!-- Options will be added dynamically -->
                                </select>
                            </td>
                            <td>
                                <input type="text" class="inputField" id=" relation2">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select class="inputField form-select" id=" studentCode3">
                                    <option value="">Select StudentCode</option>
                                    <!-- Options will be added dynamically -->
                                </select>
                            </td>
                            <td>
                                <input type="text" class="inputField" id=" relation3">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select class="inputField form-select" id=" studentCode4">
                                    <option value="">Select StudentCode</option>
                                    <!-- Options will be added dynamically -->
                                </select>
                            </td>
                            <td>
                                <input type="text" class="inputField" id=" relation4">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select class="inputField form-select" id=" studentCode5">
                                    <option value="">Select StudentCode</option>
                                    <!-- Options will be added dynamically -->
                                </select>
                            </td>
                            <td>
                                <input type="text" class="inputField" id=" relation5">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="button-position">
                    <input class="btn" type="button" value="Submit" id="btnSubmit">
                </div>
            </div>
        </div>

        <div class="card">
            <h1 class="title">Fetcher File Record</h1>
            <div class="header-card">
                <form id="myform" action="app/views/printFetcher.php" name="myform" method="POST">
                    <div class="form-group">
                        <label for="txtFetchFrom">Fetcher From:</label>
                        <input type="text" name="txtFetchFrom" class="inputField" id="txtFetchFrom">
                    </div>
                    <div class="form-group">
                        <label for="txtFetchTo">Fetcher To:</label>
                        <input type="text" name="txtFetchTo" class="inputField" id="txtFetchTo">
                    </div>
                    <div class="form-group">
                        <label for="txtregDateFrom">Reg. Date From:</label>
                        <input type="text" name="txtregDateFrom" class="inputField date" id="txtregDateFrom">
                    </div>
                    <div class="form-group">
                        <label for="txtregDateTo">Reg. Date To:</label>
                        <input type="text" name="txtregDateTo" class="inputField date" id="txtregDateTo">
                    </div>
                    <div class="form-group">
                        <input class="form-check-input" type="checkbox" name="selectStatus" id="selectStatus">
                        <label class="form-check-label" for="selectStatus">Display active fetcher only</label>
                    </div>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reportType" id="detailedReport" value="detailed">
                            <label class="form-check-label" for="detailedReport">Detailed</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reportType" id="summarizedReport" value="summarized">
                            <label class="form-check-label" for="summarizedReport">Summarized</label>
                        </div>
                    </div>
                    <div class="button-position">
                        <input type="submit" class="btn" value="Print" onclick="print_click('pdf')">
                        <input type="hidden" name="txt_repoutput">
                    </div>
                </form>
            </div>

        </div>

    </div>
</main>

<script>
    function print_click(xtype) {
        document.forms.myform.method = 'POST';
        document.forms.myform.target = '_blank';
        document.forms.myform.action = 'printFetcher.php';
        document.forms.myform.txt_repoutput.value = xtype;
        document.forms.myform.submit();
    }
</script>