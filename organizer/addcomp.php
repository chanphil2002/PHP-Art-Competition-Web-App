<?php include("../organizer/partials/header.php");

if(isset($_GET['organizerID']))
    {
        $organizerID = $_GET['organizerID'];
    } else {
        header("Location: ../organizer/orghome.php");
    }
    
?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="mx-auto">
        <h1 class="pt-5 ms-5">Create Competition</h1>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4 mx-auto">

            <div class="mb-3">
                <label for="inlineFormInput">Competition Name</label>
                <div class="input-group">
                    <input type="text" name="compName" class="form-control" id="search" 
                    placeholder="What is the Competition Name?" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="category">Category</label>
                <select class="form-control" id="exampleFormControlSelect1" name="category">
                    <option value="2D">2D</option>
                    <option value="3D">3D</option>
                    <option value="Paintings">Paintings</option>
                    <option value="Photography">Photography</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="date">Competition Release Date</label><br>
                <label class="text-secondary">(preferrably 7 days after registration date)</label>
                <div class="input-group date">
                    <input type="date" name="releaseDate" id="releaseDate" min="<?php echo date("Y-m-d"); ?>" class="form-control" 
                    placeholder="Competition Release Date" required />
                    <span class="input-group-append">
                    </span>
                </div>
            </div>

            <div class="mb-3">
                <label for="date">Competition Registration Deadline</label>
                <div class="input-group date">
                    <input type="date" name="registrationDeadline" id="registrationDeadline" min="<?php echo date("Y-m-d"); ?>" 
                    class="form-control" placeholder="When is the Deadline?" required />
                    <span class="input-group-append">
                    </span>
                </div>
            </div>

            <div class="mb-3">
                <label for="stock">Public Vote (%)</label>
                <br>
                <label class="text-secondary">(Max 100% including Judge Scoring percentage)</label>
                <input type="number" name="publicVote" class="form-control" id="publicVote" 
                placeholder="How many percentage for public vote?" required>
            </div>

            <div class="mb-3">
                <label for="stock">Judge Score (%)</label><br>
                <label class="text-secondary">(Max 100% including Public Voting percentage)</label>
                <input type="number" name="judgeScore" class="form-control" id="judgeScore" 
                placeholder="How many percentage for judge score?" required>
            </div>

            <div class="mb-3">
                <label for="price">Prize Pool (RM)</label>
                <input type="float" name="prizePool" class="form-control" id="prizePool" 
                placeholder="Enter Prize Pool..." required>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1">Competition Description</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" 
                placeholder="Tell more about the competition..." required></textarea>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1">Competition Rules and Regulations</label>
                <textarea class="form-control" name="rules" id="exampleFormControlTextarea1" rows="3" 
                placeholder="State the competition rules..." required></textarea>
            </div>

            <div class="mb-3">
                <label for="price">Competition Poster</label>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="compPic" id="compPic" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="stock">Evaluation Days</label>
                <input type="number" name="evaluationDays" class="form-control" id="evaluationDays" 
                placeholder="How many days for evaluation?" required>
            </div>

            <div class="mb-3">
                <label for="price">Competition Receipt</label>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="receipt" id="receipt" required>
                </div>
            </div>

            <hr class="mb-4">
            <input type="hidden" id='organizerID' name='organizerID' value= "<?php echo $organizerID;?>">
            <button class="btn btn-primary btn-lg btn-block mx-auto d-flex px-5" name="submit" type="submit">Continue</button>
        </div>
    </div>

</form>



<?php
ob_start();
//Add data into variables
if (isset($_POST['submit'])) {
    $organizerID = $_POST['organizerID'];
    $compName = $_POST['compName'];
    $category = $_POST['category'];
    $releaseDate = $_POST['releaseDate'];
    $registrationDeadline = $_POST['registrationDeadline'];
    $publicVote = $_POST['publicVote'];
    $judgeScore = $_POST['judgeScore'];
    $prizePool = $_POST['prizePool'];
    $description = $_POST['description'];
    $rules = $_POST['rules'];
    $evaluationDays = $_POST['evaluationDays'];

    //Get photo, change file name & Add into specific folder
    if (isset($_FILES['compPic']['name'])) {
        $compPic = $_FILES['compPic']['name'];
        $image = explode('.', $compPic);
        $ext = end($image);
        $compPic = rand(000, 999) . "." . $ext;
        $source = $_FILES['compPic']['tmp_name'];
        $destination = "../materials/compPic/" . $compPic;
        $upload = move_uploaded_file($source, $destination);
    } else {
        $compPic = "";
    }

    //Get the receipt, Change receipt name & Append into Specific Folder
    if (isset($_FILES['receipt']['name'])) {
        $receipt = $_FILES['receipt']['name'];
        $image1 = explode('.', $receipt);
        $ext1 = end($image1);
        $receipt = rand(000, 999) . "." . $ext1;
        $source1 = $_FILES['receipt']['tmp_name'];
        $destination1 = "../materials/compReceipt/" . $receipt;
        $upload1 = move_uploaded_file($source1, $destination1);
    } else {
        $receipt = "";
    }

    //Add the competition data into Competition column
    $sql = "INSERT INTO competition SET
            compName = '$compName',
            organizerID = $organizerID,
            description = '$description',
            rules = '$rules',
            category = '$category',
            status = 'Pending',
            releaseDate = '$releaseDate',
            registrationDeadline = '$registrationDeadline',
            evaluationDays = $evaluationDays,
            judgeScore = $judgeScore,
            publicVote = $publicVote,
            prizePool = $prizePool,
            compPic = '$compPic',
            receipt = '$receipt'";

    $res = mysqli_query($conn, $sql);

    //Direct user to the Judges Allocation page when the competition data added successfully
    if ($res == true) {
        $sql3 = "SELECT compID FROM competition WHERE compName = '$compName' ORDER BY compID DESC LIMIT 1; ";
        $res3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_assoc($res3);
        $compID = $row3['compID'];
        $_SESSION['compID'] = $compID;
        echo $_SESSION['compID'];
        header("location:" . SITEURL . "organizer/selectedjudge.php");
    }
}
include("../organizer/partials/footer.php");
?>