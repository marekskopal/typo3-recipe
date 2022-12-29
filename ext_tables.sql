#
# Table structure for table 'tx_news_domain_model_news'
#
CREATE TABLE tx_news_domain_model_news (
    ingredient_sections int(11) DEFAULT '0' NOT NULL,
    instruction_sections int(11) DEFAULT '0' NOT NULL,
    ingredient_text text,
    instruction_text text,
    nutrition_yield tinytext,
    nutrition_calories int(11) DEFAULT '0' NOT NULL,
    nutrition_proteins int(11) DEFAULT '0' NOT NULL,
    nutrition_carbs int(11) DEFAULT '0' NOT NULL,
    nutrition_fats int(11) DEFAULT '0' NOT NULL,
    nutrition_fiber int(11) DEFAULT '0' NOT NULL
);

#
# Table structure for table 'tx_msrecipe_domain_model_ingredient'
#
CREATE TABLE tx_msrecipe_domain_model_ingredient (
	uid int(11) NOT NULL AUTO_INCREMENT,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumtext,
	l10n_source int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,

    ingredient_section int(11) unsigned DEFAULT '0' NOT NULL,
	ingredient tinytext,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY sys_language_uid_l10n_parent (sys_language_uid,l10n_parent)
);

#
# Table structure for table 'tx_msrecipe_domain_model_ingredientsection'
#
CREATE TABLE tx_msrecipe_domain_model_ingredientsection (
	uid int(11) NOT NULL AUTO_INCREMENT,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumtext,
	l10n_source int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,

    news int(11) unsigned DEFAULT '0' NOT NULL,
    ingredients int(11) unsigned DEFAULT '0' NOT NULL,
	title tinytext,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY sys_language_uid_l10n_parent (sys_language_uid,l10n_parent)
);

#
# Table structure for table 'tx_msrecipe_domain_model_instruction'
#
CREATE TABLE tx_msrecipe_domain_model_instruction (
	uid int(11) NOT NULL AUTO_INCREMENT,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumtext,
	l10n_source int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,

    instruction_section int(11) unsigned DEFAULT '0' NOT NULL,
	instruction text,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY sys_language_uid_l10n_parent (sys_language_uid,l10n_parent)
);

#
# Table structure for table 'tx_msrecipe_domain_model_instructionsection'
#
CREATE TABLE tx_msrecipe_domain_model_instructionsection (
	uid int(11) NOT NULL AUTO_INCREMENT,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumtext,
	l10n_source int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,

    news int(11) unsigned DEFAULT '0' NOT NULL,
    instructions int(11) unsigned DEFAULT '0' NOT NULL,
	title tinytext,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY sys_language_uid_l10n_parent (sys_language_uid,l10n_parent)
);
