<?php
/*
Template Name: Executive Order
*/
?>

<?php get_header(); ?>
<div class="sixteen columns section sectionBlue">
	<h1>Executive Order</h1>
	<p class="subtitle hugeSubtitle">Establishment of the Presidential Commission of Election Administration</p>
</div>
<div class="main sixteen columns">
	<div class="content twelve columns alpha">
<h1></h1>
<p>By the authority vested in me as President by the Constitution and the laws of the United States of America, and in order to promote the efficient administration of Federal elections and to improve the experience of all voters, it is hereby ordered as follows:</p>
<p><u>Section</u> <u>1</u>. <u>Establishment</u>. There is established the Presidential Commission on Election Administration (Commission).</p>
<p><u>Sec</u>. <u>2</u>. <u>Membership</u>. (a) The Commission shall be composed of not more than ten members appointed by the President. The members shall be drawn from among distinguished individuals with knowledge about or experience in the administration of State or local elections, as well as representatives of successful customer service-oriented businesses, and any other individuals with knowledge or experience determined by the President to be of value to the Commission.</p>
<p>(b) The President shall designate two members of the Commission to serve as Co-Chairs.</p>
<p><u>Sec</u>. <u>3</u>. <u>Mission</u>. (a) The Commission shall identify best practices and otherwise make recommendations to promote the efficient administration of elections in order to ensure that all eligible voters have the opportunity to cast their ballots without undue delay, and to improve the experience of voters facing other obstacles in casting their ballots, such as members of the military, overseas voters, voters with disabilities, and voters with limited English proficiency.</p>
<p>In doing so, the Commission shall consider as appropriate:</p>
<p>(i) the number, location, management, operation, and design of polling places;</p>
<p>(ii) the training, recruitment, and number of poll workers;</p>
<p>(iii) voting accessibility for uniformed and overseas voters;</p>
<p>(iv) the efficient management of voter rolls and poll books;</p>
<p>(v) voting machine capacity and technology;</p>
<p>(vi) ballot simplicity and voter education;</p>
<p>(vii) voting accessibility for individuals with disabilities, limited English proficiency, and other special needs;</p>
<p>(viii) management of issuing and processing provisional ballots in the polling place on Election Day;</p>
<p>(ix) the issues presented by the administration of absentee ballot programs;</p>
<p>(x) the adequacy of contingency plans for natural disasters and other emergencies that may disrupt elections; and</p>
<p>(xi) other issues related to the efficient administration of elections that the Co-Chairs agree are necessary and appropriate to the Commission's work.</p>
<p>(b) The Commission shall be advisory in nature and shall submit a final report to the President within 6 months of the date of the Commission's first public meeting.</p>
<p><u>Sec</u>. <u>4</u>. <u>Administration</u>. (a) The Commission shall hold public meetings and engage with Federal, State, and local officials, technical advisors, and nongovernmental organizations, as necessary to carry out its mission.</p>
<p>(b) In carrying out its mission, the Commission shall be informed by, and shall strive to avoid duplicating, the efforts of other governmental entities.</p>
<p>(c) The Commission shall have a staff, which shall provide support for the functions of the Commission.</p>
<p><u>Sec</u>. <u>5</u>. <u>Termination</u>. The Commission shall terminate 30 days after it presents its final report to the President.</p>
<p><u>Sec</u>. <u>6</u>. <u>General Provisions</u>. (a) To the extent permitted by law, and subject to the availability of appropriations, the General Services Administration shall provide the Commission with such administrative services, funds, facilities, staff, equipment, and other support services as may be necessary to carry out its mission on a reimbursable basis.</p>
<p>(b) Insofar as the Federal Advisory Committee Act, as amended (5 U.S.C. App.) (the "Act"), may apply to the Commission, any functions of the President under that Act, except for those in section 6 of the Act, shall be performed by the Administrator of General Services.</p>
<p>(c) Members of the Commission shall serve without any additional compensation for their work on the Commission, but shall be allowed travel expenses, including per diem in lieu of subsistence, to the extent permitted by law for persons serving intermittently in the Government service (5 U.S.C. 5701-5707).</p>
<p>(d) Nothing in this order shall be construed to impair or otherwise affect:</p>
<p>(i) the authority granted by law to a department, agency, or the head thereof; or</p>
<p>(ii) the functions of the Director of the Office of Management and Budget relating to budgetary, administrative, or legislative proposals.</p>
<p>(e) This order is not intended to, and does not, create any right or benefit, substantive or procedural, enforceable at law or in equity by any party against the United States, its departments, agencies, or entities, its officers, employees, or agents, or any other person.</p>
<p class="center">BARACK OBAMA</p>
	</div>
	<div class="sidebar four columns omega blogRoll">
		<h3>Recent News</h3>
		<?php query_posts('showposts=3&order=desc'); ?>
		<?php if ( have_posts() ) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<div class="sidebar-widget" id="widget-id-<?php the_ID();?>">
					<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h4>
					<span class="date"><?php the_time('F j, Y'); ?></span>
				</div>
			<?php endwhile; ?>
		<?php endif; wp_reset_query(); ?>
	</div>
</div>

<?php get_footer(); ?>