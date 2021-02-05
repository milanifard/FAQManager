drop table if exists faq_temp;
create table faq_temp(
    id int,
    slug text
);

insert into systemfacilitygroups(groupname, orderno)
values ('پرسش و پاسخ', 5);

insert into faq_temp(id, slug)
select last_insert_id(), 'facility_group';

insert into systemfacilities(FacilityName, GroupID, OrderNo, PageAddress)
select 'جستجو', faq_temp.id, 1, 'FAQManager/Search.php'
from faq_temp
where slug = 'facility_group';
insert into faq_temp(id, slug)
select last_insert_id(), 'search_page';

insert into facilitypages(FacilityID, PageName)
select id, '/Search.php'
from faq_temp
where slug = 'search_page';

insert into systemfacilities(FacilityName, GroupID, OrderNo, PageAddress)
select 'افزودن FAQ', faq_temp.id, 2, 'FAQManager/AddFAQ.php'
from faq_temp
where slug = 'facility_group';
insert into faq_temp(id, slug)
select last_insert_id(), 'insert';

insert into facilitypages(FacilityID, PageName)
select id, '/AddFAQ.php'
from faq_temp
where slug = 'insert';

insert into faq_temp(id, slug)
select last_insert_id(), 'show_faq';
insert into facilitypages(FacilityID, PageName)
select id, '/ShowFAQ.php'
from faq_temp
where slug = 'show_faq';

insert into systemfacilities(FacilityName, GroupID, OrderNo, PageAddress)
select 'ارسال تیکت', faq_temp.id, 3, 'FAQManager/Ticketing.php'
from faq_temp
where slug = 'facility_group';
insert into faq_temp(id, slug)
select last_insert_id(), 'ticketing';

insert into facilitypages(FacilityID, PageName)
select id, '/Ticketing.php'
from faq_temp
where slug = 'ticketing';

insert into systemfacilities(FacilityName, GroupID, OrderNo, PageAddress)
select 'کلمات پیشنهادی', faq_temp.id, 4, 'FAQManager/KeywordManaging.php'
from faq_temp
where slug = 'facility_group';
insert into faq_temp(id, slug)
select last_insert_id(), 'suggest';

insert into facilitypages(FacilityID, PageName)
select id, '/KeywordManaging.php'
from faq_temp
where slug = 'suggest';

insert into userfacilities(UserID, FacilityID)
select 'omid', faq_temp.id
from faq_temp
where slug <> 'facility_group';

drop table faq_temp;