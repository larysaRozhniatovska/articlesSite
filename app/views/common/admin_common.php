<h1>WELCOME <?= $login ?></h1>

<!--<div class="w3-container w3-padding w3-teal">-->
<!--    <button class="w3-right " type="button" >-->
<!--        <a href="--><?php //= \app\lib\Router::url('signOutUser')?><!--"> <i class="fa fa-sign-out" aria-hidden="true"></i></a></button>-->
<!--    <div class="w3-right w3-margin-right "><i class="fa fa-user-o" aria-hidden="true"></i>--><?php //= $login ?><!--</div>-->
<!--</div>-->
<!--<form action="--><?php //= \app\lib\Router::url('addNote')?><!--" method="post"-->
<!--      class="w3-content w3-center" style="max-width:500px">-->
<!--    <div class="w3-content w3-center">-->
<!--        <label for="id-note">Enter a note:</label><br>-->
<!--        <textarea style="min-width:100%" id="id-note" name="note" rows="5" cols="33">It was a dark and stormy night... </textarea>-->
<!--    </div>-->
<!--    <div class="w3-container w3-center">-->
<!--        <button class="w3-btn w3-teal" style="min-width:50%">Add Note</button>-->
<!--    </div>-->
<!--</form>-->
<!--<div class="w3-container w3-center w3-padding-12 w3-margin">-->
<!--    <table class="w3-table w3-hoverable  w3-striped w3-bordered w3-border w3-small" style="max-width:80%">-->
<!--        <thead>-->
<!--        <tr class="w3-grey">-->
<!--            <th class="w3-center w3-border">#</th>-->
<!--            <th class="w3-center w3-border">Note</th>-->
<!--            <th class="w3-center w3-border">Action</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        --><?php //if(!empty($notes)):?>
<!--            <tbody>-->
<!--            --><?php //for ($i = 0; $i < count($notes); $i++): ?>
<!--                <tr class="w3-border-bottom w3-border-right">-->
<!--                    <td class="w3-centered w3-border">--><?php //= $i+1 ?><!--</td>-->
<!--                    <td class="w3-border">--><?php //= $notes[$i]?><!--</p></td>-->
<!--                    <td class="w3-centered w3-border">-->
<!--                        <form action="--><?php //= \app\lib\Router::url('delNote')?><!--" class="w3-container w3-center"-->
<!--                              method="post">-->
<!--                            <input type="hidden" name="idDel" value="--><?php //=$i?><!--">-->
<!--                            <button >-->
<!--                                <i class="fa fa-trash-o" aria-hidden="true" style="color:red"></i>--><?php //=$i?><!--</button>-->
<!--                        </form>-->
<!--                    </td>-->
<!--                </tr>-->
<!--            --><?php //endfor; ?>
<!--            </tbody>-->
<!--        --><?php //endif; ?>
<!--    </table>-->
<!--</div>-->
<!--<i class="fa fa-user-plus" aria-hidden="true"></i>-->