<div class="side-nav-div animated fadeInLeft">
	<div class="side-in-div">
        <div class="nav-div active-li" title="Dashboard" onClick="_get_page('dashboard', 'dashboard')" id="dashboard">
            <div class="icon"><i class="bi-speedometer2"></i></div> Dashboard
            <div class="hidden" id="_dashboard"><i class="bi-speedometer2"></i> Admin Dashboard Overview</div>
        </div>

        <script>_side_admin_check('admin');</script>

        <div class="nav-div" title="Subject" onClick="_get_page('all_subject', 'subject')" id="subject">
            <div class="icon"><i class="bi-book"></i></div> Subject
            <div class="hidden" id="_subject"><i class="bi-book"></i> All Subjects</div>
        </div>

        <div class="nav-div" title="Classes" onClick="_get_page('all_class', 'class')" id="class">
            <div class="icon"><i class="bi-book"></i></div> Classes
            <div class="hidden" id="_class"><i class="bi-book"></i> All Classes</div>
        </div>

        <div class="nav-div" title="Classification" onClick="_get_page('all_department', 'department')" id="department">
            <div class="icon"><i class="bi-easel"></i></div> Classification
            <div class="hidden" id="_department"><i class="bi-easel"></i> Classification</div>
        </div>

        <div class="nav-div" title="Tutorial" onClick="_get_form('select_class_form', 'tutor')" id="tutor">
            <div class="icon" ><i class="bi-pencil-square"></i></div> Tutorial
            <div class="hidden" id="_tutor"><i class="bi-pencil-square"></i> Tutorial</div>
        </div>

        <script>_side_admin_check('agents');</script>

        <script>_side_admin_check('user');</script>          
	</div>
</div> 